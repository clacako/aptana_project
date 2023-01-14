<?php

    $uri_segment    = $this->uri->segment(1);
    $dashboard      = "";
    $campaigns      = "";
    $landing_page_builder      = "";
    $redeem_coupon  = "";
    $contacts       = "";
    $wa_assistant   = "";
    $settings       = "";
    $font_color     = "";

    switch ($uri_segment) {
        case 'Dashboard':
            $dashboard  = 'active';
            $font_color = "text-danger";
            break;
        
        case 'Campaigns':
            $campaigns = 'active';
            $font_color = "text-danger";
            break;

        case 'LandingPageBuilder':
            $landing_page_builder = 'active';
            $font_color = "text-danger";
            break;

        case 'RedeemCoupon':
            $redeem_coupon = 'active';
            $font_color = "text-danger";
            break;

        case 'Contact':
            $contacts = 'active';
            $font_color = "text-danger";
            break;

        case 'WaAssistant':
            $wa_assistant = 'active';
            $font_color = "text-danger";
            break;

        case 'Settings':
            $settings = 'active';
            $font_color = "text-danger";
            break;

        default:
        $font_color = "text-danger";    
        break;
    }

?>

<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <!-- <li>
            <a href="<?= base_url('Dashboard');?>" class="waves-effect <?= $dashboard; ?>"><i class="fas fa-server"></i> <span> Dashboard </span> </a>
        </li> -->
        <li>
            <a href="<?= base_url('Campaigns');?>" class="waves-effect <?= $campaigns; ?>"><i class="fas fa-th-list"></i> <span> Campaigns </span> </a>
        </li>
        <li>
            <a href="<?= base_url('RedeemCoupon');?>" class="waves-effect <?= $redeem_coupon; ?>"><i class="fas fa-tags"></i> <span> Redeem Coupon </span> </a>
        </li>
        <li>
            <a href="<?= base_url('LandingPageBuilder');?>" class="waves-effect <?= $landing_page_builder; ?>"><i class="fa fa-gavel"></i> <span> Landing Page </span> </a>
        </li>
        <!-- <li>
            <a href="<?= base_url('Contacts');?>" class="waves-effect <?= $contacts; ?>"><i class="fas fa-user"></i> <span> Contacts </span> </a>
        </li> -->
        <li>
            <a href="<?= base_url('WaAssistant');?>" class="waves-effect <?= $wa_assistant; ?>"><i class="fab fa-whatsapp"></i> <span> Wa Assistant </span> </a>
        </li>
        <li>
            <a href="<?= base_url('Settings');?>" class="waves-effect <?= $settings; ?>"><i class="fab fa-whmcs"></i> <span> Settings </span> </a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
