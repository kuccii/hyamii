@if (user_can('Manage Superadmin Settings'))
    @livewire('sidebar-menu-item', [
        'name' => __('RRA EBM Settings'),
        'icon' => 'settings',
        'link' => route('superadmin.rra-ebm.index'),
        'active' => request()->routeIs('superadmin.rra-ebm.*')
    ])
@endif
