@if (user_can('Manage Settings'))
    @livewire('sidebar-menu-item', [
        'name' => 'RRA EBM',
        'icon' => 'billing',
        'link' => route('rra-ebm.index'),
        'active' => request()->routeIs('rra-ebm.*')
    ])
@endif