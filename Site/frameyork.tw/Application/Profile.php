<?php

namespace Application;

class Profile extends \Template\AMaster
{
    public function information()
    {
        $this->addCss('/assets/css/components.min.css');
        $this->addCss('/assets/css/profile.min.css');
        $this->setTitle('個人資訊');
        $data = array('include_page' => 'information.phtml');
        $this->display('/profile.phtml',$data);
    }

    public function experience()
    {
        $this->addCss('/assets/css/components.min.css');
        $this->addCss('/assets/css/profile.min.css');
        $this->setTitle('經歷');
        $data = array('include_page' => 'experience.phtml');
        $this->display('/profile.phtml',$data);
    }

    public function skill()
    {
        $this->addCss('/assets/css/components.min.css');
        $this->addCss('/assets/css/profile.min.css');
        $this->addScript('/assets/js/skill-star.js');
        $this->setTitle('技能專長');
        $data = array('include_page' => 'skill.phtml');
        $this->display('/profile.phtml',$data);
    }
}
