<?php

namespace App\Services;

use App\Models\WilayahCache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahService
{
    protected $baseUrl = 'https://wilayah.id/api';
    protected $cacheDuration = 86400; // 24 jam

    /**
     * Get all provinces
     */
    public function getProvinces()
    {
        // Cek cache database dulu
        $cached = WilayahCache::province()->get();
        
        if ($cached->isNotEmpty() && $cached->first()->cached_at->diffInHours(now()) < 24) {
            return $cached;
        }

        try {
            $response = Http::timeout(30)->get("{$this->baseUrl}/provinces.json");
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Simpan ke database cache
                foreach ($data as $province) {
                    WilayahCache::updateOrCreate(
                        ['code' => $province['code']],
                        [
                            'type' => 'province',
                            'parent_code' => null,
                            'name' => $province['name'],
                            'meta_data' => $province,
                            'cached_at' => now(),
                        ]
                    );
                }
                
                return WilayahCache::province()->get();
            }
        } catch (\Exception $e) {
            // Fallback ke cache database
            return $cached;
        }

        return collect([]);
    }

    /**
     * Get regencies by province code
     */
    public function getRegencies($provinceCode)
    {
        $cached = WilayahCache::regency()->byParent($provinceCode)->get();
        
        if ($cached->isNotEmpty() && $cached->first()->cached_at->diffInHours(now()) < 24) {
            return $cached;
        }

        try {
            $response = Http::timeout(30)->get("{$this->baseUrl}/regencies/{$provinceCode}.json");
            
            if ($response->successful()) {
                $data = $response->json();
                
                foreach ($data as $regency) {
                    WilayahCache::updateOrCreate(
                        ['code' => $regency['code']],
                        [
                            'type' => 'regency',
                            'parent_code' => $provinceCode,
                            'name' => $regency['name'],
                            'meta_data' => $regency,
                            'cached_at' => now(),
                        ]
                    );
                }
                
                return WilayahCache::regency()->byParent($provinceCode)->get();
            }
        } catch (\Exception $e) {
            return $cached;
        }

        return collect([]);
    }

    /**
     * Get districts by regency code
     */
    public function getDistricts($regencyCode)
    {
        $cached = WilayahCache::district()->byParent($regencyCode)->get();
        
        if ($cached->isNotEmpty() && $cached->first()->cached_at->diffInHours(now()) < 24) {
            return $cached;
        }

        try {
            $response = Http::timeout(30)->get("{$this->baseUrl}/districts/{$regencyCode}.json");
            
            if ($response->successful()) {
                $data = $response->json();
                
                foreach ($data as $district) {
                    WilayahCache::updateOrCreate(
                        ['code' => $district['code']],
                        [
                            'type' => 'district',
                            'parent_code' => $regencyCode,
                            'name' => $district['name'],
                            'meta_data' => $district,
                            'cached_at' => now(),
                        ]
                    );
                }
                
                return WilayahCache::district()->byParent($regencyCode)->get();
            }
        } catch (\Exception $e) {
            return $cached;
        }

        return collect([]);
    }

    /**
     * Get villages by district code
     */
    public function getVillages($districtCode)
    {
        $cached = WilayahCache::village()->byParent($districtCode)->get();
        
        if ($cached->isNotEmpty() && $cached->first()->cached_at->diffInHours(now()) < 24) {
            return $cached;
        }

        try {
            $response = Http::timeout(30)->get("{$this->baseUrl}/villages/{$districtCode}.json");
            
            if ($response->successful()) {
                $data = $response->json();
                
                foreach ($data as $village) {
                    WilayahCache::updateOrCreate(
                        ['code' => $village['code']],
                        [
                            'type' => 'village',
                            'parent_code' => $districtCode,
                            'name' => $village['name'],
                            'meta_data' => $village,
                            'cached_at' => now(),
                        ]
                    );
                }
                
                return WilayahCache::village()->byParent($districtCode)->get();
            }
        } catch (\Exception $e) {
            return $cached;
        }

        return collect([]);
    }

    /**
     * Search wilayah by name
     */
    public function searchWilayah($type, $keyword)
    {
        return WilayahCache::where('type', $type)
            ->where('name', 'like', "%{$keyword}%")
            ->limit(20)
            ->get();
    }

    /**
     * Clear old cache
     */
    public function clearOldCache()
    {
        WilayahCache::where('cached_at', '<', now()->subDays(7))->delete();
    }
}