<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WilayahController extends Controller
{
    protected $baseUrl = 'https://wilayah.id/api';
    
    /**
     * Get all provinces
     */
    public function provinsi()
    {
        try {
            // Coba dari cache dulu
            $cached = Cache::get('provinces');
            if ($cached) {
                return response()->json([
                    'success' => true,
                    'data' => $cached
                ]);
            }
            
            // Coba fetch dari API dengan SSL verification dinonaktifkan
            $response = Http::withOptions([
                'verify' => false, // Nonaktifkan SSL verification
                'timeout' => 10,
            ])->get($this->baseUrl . '/provinces.json');
            
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Ekstrak array 'data' dari response wilayah.id: {"data": [...], "meta": {...}}
                $data = isset($responseData['data']) && is_array($responseData['data'])
                    ? $responseData['data']
                    : (is_array($responseData) ? $responseData : []);
                
                // Cache untuk 1 jam
                Cache::put('provinces', $data, 3600);
                
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
            
            // Fallback ke data static
            return $this->getStaticProvinces();
            
        } catch (\Exception $e) {
            Log::error('Error fetching provinces: ' . $e->getMessage());
            
            // Fallback ke data static
            return $this->getStaticProvinces();
        }
    }
    
    /**
     * Get regencies by province code
     */
    public function kabupaten($provinceCode)
    {
        try {
            $cacheKey = 'regencies_' . $provinceCode;
            $cached = Cache::get($cacheKey);
            
            if ($cached) {
                return response()->json([
                    'success' => true,
                    'data' => $cached
                ]);
            }
            
            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 10,
            ])->get($this->baseUrl . '/regencies/' . $provinceCode . '.json');
            
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Ekstrak array 'data' dari response wilayah.id
                $data = isset($responseData['data']) && is_array($responseData['data'])
                    ? $responseData['data']
                    : (is_array($responseData) ? $responseData : []);
                
                Cache::put($cacheKey, $data, 3600);
                
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
            
            // Fallback ke data kosong
            return response()->json([
                'success' => true,
                'data' => []
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error fetching regencies: ' . $e->getMessage());
            
            return response()->json([
                'success' => true,
                'data' => []
            ]);
        }
    }
    
    /**
     * Get districts by regency code
     */
    public function kecamatan($regencyCode)
    {
        try {
            $cacheKey = 'districts_' . $regencyCode;
            $cached = Cache::get($cacheKey);
            
            if ($cached) {
                return response()->json([
                    'success' => true,
                    'data' => $cached
                ]);
            }
            
            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 10,
            ])->get($this->baseUrl . '/districts/' . $regencyCode . '.json');
            
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Ekstrak array 'data' dari response wilayah.id
                $data = isset($responseData['data']) && is_array($responseData['data'])
                    ? $responseData['data']
                    : (is_array($responseData) ? $responseData : []);
                
                Cache::put($cacheKey, $data, 3600);
                
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
            
            return response()->json([
                'success' => true,
                'data' => []
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error fetching districts: ' . $e->getMessage());
            
            return response()->json([
                'success' => true,
                'data' => []
            ]);
        }
    }
    
    /**
     * Get villages by district code
     */
    public function kelurahan($districtCode)
    {
        try {
            $cacheKey = 'villages_' . $districtCode;
            $cached = Cache::get($cacheKey);
            
            if ($cached) {
                return response()->json([
                    'success' => true,
                    'data' => $cached
                ]);
            }
            
            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 10,
            ])->get($this->baseUrl . '/villages/' . $districtCode . '.json');
            
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Ekstrak array 'data' dari response wilayah.id
                $data = isset($responseData['data']) && is_array($responseData['data'])
                    ? $responseData['data']
                    : (is_array($responseData) ? $responseData : []);
                
                Cache::put($cacheKey, $data, 3600);
                
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }
            
            return response()->json([
                'success' => true,
                'data' => []
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error fetching villages: ' . $e->getMessage());
            
            return response()->json([
                'success' => true,
                'data' => []
            ]);
        }
    }
    
    /**
     * Get static provinces as fallback
     */
    private function getStaticProvinces()
    {
        $provinces = [
            ['code' => '11', 'name' => 'ACEH'],
            ['code' => '12', 'name' => 'SUMATERA UTARA'],
            ['code' => '13', 'name' => 'SUMATERA BARAT'],
            ['code' => '14', 'name' => 'RIAU'],
            ['code' => '15', 'name' => 'JAMBI'],
            ['code' => '16', 'name' => 'SUMATERA SELATAN'],
            ['code' => '17', 'name' => 'BENGKULU'],
            ['code' => '18', 'name' => 'LAMPUNG'],
            ['code' => '19', 'name' => 'KEPULAUAN BANGKA BELITUNG'],
            ['code' => '21', 'name' => 'KEPULAUAN RIAU'],
            ['code' => '31', 'name' => 'DKI JAKARTA'],
            ['code' => '32', 'name' => 'JAWA BARAT'],
            ['code' => '33', 'name' => 'JAWA TENGAH'],
            ['code' => '34', 'name' => 'DI YOGYAKARTA'],
            ['code' => '35', 'name' => 'JAWA TIMUR'],
            ['code' => '36', 'name' => 'BANTEN'],
            ['code' => '51', 'name' => 'BALI'],
            ['code' => '52', 'name' => 'NUSA TENGGARA BARAT'],
            ['code' => '53', 'name' => 'NUSA TENGGARA TIMUR'],
            ['code' => '61', 'name' => 'KALIMANTAN BARAT'],
            ['code' => '62', 'name' => 'KALIMANTAN TENGAH'],
            ['code' => '63', 'name' => 'KALIMANTAN SELATAN'],
            ['code' => '64', 'name' => 'KALIMANTAN TIMUR'],
            ['code' => '65', 'name' => 'KALIMANTAN UTARA'],
            ['code' => '71', 'name' => 'SULAWESI UTARA'],
            ['code' => '72', 'name' => 'SULAWESI TENGAH'],
            ['code' => '73', 'name' => 'SULAWESI SELATAN'],
            ['code' => '74', 'name' => 'SULAWESI TENGGARA'],
            ['code' => '75', 'name' => 'GORONTALO'],
            ['code' => '76', 'name' => 'SULAWESI BARAT'],
            ['code' => '81', 'name' => 'MALUKU'],
            ['code' => '82', 'name' => 'MALUKU UTARA'],
            ['code' => '91', 'name' => 'PAPUA BARAT'],
            ['code' => '94', 'name' => 'PAPUA'],
        ];
        
        return response()->json([
            'success' => true,
            'data' => $provinces,
            'source' => 'static'
        ]);
    }
    
    /**
     * Search wilayah
     */
    public function search(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }
}