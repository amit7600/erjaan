<?php
$user = Auth::user();
$role = $user->user_role;
?>


<div class="menu_section">
    <ul class="nav side-menu">
        <li>
            <a href="{{route('dashboard')}}">Dashboard</a>
        </li>
        @if($role == 0)
        <li>
            <a>Manage Blackbelt Retail<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('repairman.index')}}">Blackbelt Retail</a></li>
                <li><a href="{{route('repairman.create')}}">Add Blackbelt Retail</a></li>
            </ul>
        </li>

        <li>
            <a>Manage Functions<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('retailcategory.create')}}">Add Function</a></li>
                <li><a href="{{route('retailcategory.index')}}">Function List</a></li>
            </ul>
        </li>
        @endif

        <li>
            <a>Manage Tickets <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('ticket.index')}}">Ticket List</a></li>
                <li><a href="{{route('ticket.create')}}">Add Ticket</a></li>
                <li><a href="{{'http://devicediagnostics.co.uk'}}" target="_blank">Diagnostics</a></li>
                <li><a href="javascript:void(0);">FMIP/Blacklist</a></li>
            </ul>
        </li>
        <li>
            <a>Manage Invoice <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('invoice.index')}}">Invoice List</a></li>
                <li><a href="{{route('invoice.create')}}">Add Invoice</a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('logout')}}">Log Out</a>
        </li>
    </ul>
</div>
