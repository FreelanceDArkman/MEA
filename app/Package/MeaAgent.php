<?php
namespace App\Package;

use Jenssegers\Agent\Agent;

class MeaAgent extends Agent
{

    public function access_channel()
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            return "Mobile";
        } elseif ($agent->isTablet()) {
            return "Tablet";
        } else {
            return "Web";
        }
    }
}