<div class="modal-body">
    <div class="text-center py-8">
        <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-lg font-medium text-green-700">Module is ready to use</p>
        <p class="text-sm text-gray-500 mt-1">{{ ucwords($module) }} is installed and verified.</p>
    </div>
</div>

<script>
    setTimeout(function() { window.location.reload(); }, 1500);
</script>
