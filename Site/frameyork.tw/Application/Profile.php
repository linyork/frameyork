<?php

namespace Application;

class Profile extends \Template\AMaster
{
    public function education()
    {
        $this->addCss('/assets/css/components.min.css');
        $this->addCss('/assets/css/profile.min.css');
        $this->setTitle('學歷');
        $data = array('include_page' => 'education.phtml');
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
        $this->setTitle('技能專長');
        $data = array('include_page' => 'skill.phtml');
        $this->display('/profile.phtml',$data);
    }
}
