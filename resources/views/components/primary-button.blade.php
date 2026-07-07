<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#9b2f51] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#7a2540] focus:bg-[#7a2540] active:bg-[#601930] focus:outline-none focus:ring-2 focus:ring-[#9b2f51] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
