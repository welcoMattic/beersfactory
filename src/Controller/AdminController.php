<?php

namespace App\Controller;

use App\Entity\Beer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    /**
     * @Route("/dashboard", name="admin_dashboard")w
     */
    public function dashboard()
    {
        return $this->render('admin/dashboard.html.twig');
    }

    protected function createSearchQueryBuilder($entityClass, $searchQuery, array $searchableFields, $sortField = null, $sortDirection = null, $dqlFilter = null)
    {
        $qb = parent::createSearchQueryBuilder($entityClass, $searchQuery, $searchableFields, $sortField, $sortDirection, $dqlFilter);

        if ($entityClass === Beer::class) {
            $qb->innerJoin('entity.category', 'c')
                ->orWhere('LOWER(c.name) LIKE :category_name')
                ->setParameter('category_name', '%'.$searchQuery.'%')
            ;
        }

        return $qb;
    }
}
