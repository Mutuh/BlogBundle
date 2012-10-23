<?php

namespace Stfalcon\Bundle\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Stfalcon\Bundle\BlogBundle\Entity\Tag;

/**
 * TagController
 *
 * @author Stepan Tanasiychuk <ceo@stfalcon.com>
 */
class TagController extends AbstractController
{

    /**
     * View tag
     *
     * @param Tag $tag  Tag
     * @param int $page Page number
     *
     * @return array
     */
    public function viewAction(Tag $tag, $page)
    {
        $pageRange = $this->container->getParameter('page_range');
        $posts     = $this->get('knp_paginator')->paginate($tag->getPosts(), $page, $pageRange);

        if ($this->has('menu.breadcrumbs')) {
            $breadcrumbs = $this->get('menu.breadcrumbs');
            $breadcrumbs->addChild('Блог', $this->get('router')->generate('blog'));
            $breadcrumbs->addChild($tag->getText())->setIsCurrent(true);
        }

        return array(
            'tag'   => $tag,
            'posts' => $posts,
        ));
    }

}
