<?php

namespace App\Controller\Admin;

use App\Entity\Category; 
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use App\Controller\Admin\CategoryCrudController;
use App\Controller\Admin\ArticleCrudController;
use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Repository\CategoryRepository;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
    
    $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
    return $this->redirect($adminUrlGenerator->setController (CategoryCrudController::class)->generateUrl());

    
    $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
    return $this->redirect($adminUrlGenerator->setController (ArticleCrudController::class)->generateUrl());
    
    }

   


    
    public function configureDashboard(): Dashboard
    {
    return Dashboard::new()
    ->setTitle('Stock Management');
    }
    public function configureMenuItems(): iterable
    {
    yield MenuItem:: linkToDashboard ('Dashboard', 'fa fa-home ');

    yield MenuItem::linkToCrud('Category', 'fa fa-bars', Category::class);
    yield MenuItem::linkToCrud('Article', 'fa fa-shopping-cart', Article::class);

    }
    


        
}
  

