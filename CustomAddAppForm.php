<?php

namespace Drupal\consumer\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\apigee_edge\Entity\Form\DeveloperAppCreateFormForDeveloper;
use Drupal\user\Entity\User;
use Drupal\user\UserInterface;
use Drupal\Core\Form\FormStateInterface;

class CustomAddAppForm extends ControllerBase {
	/**
   * Main tab.
   */
  public function mainTab() {
    \Drupal::service('page_cache_kill_switch')->trigger();
    $request = \Drupal::request();
    $session = $request->getSession();
    $user = \Drupal::currentUser();
    $user_id = $user->id();
    $email = $user->getEmail();
    $developer_app_storage = \Drupal::entityTypeManager()->getStorage('developer_app');
    $appsList = array();
    foreach ($developer_app_storage->loadByDeveloper($email) as $app) {
      $appsList[$app->getAppId()] = $app->getName();
      //kint($app);
    }
    //print_r($appsList);die;
    //print $user_id;die;
    return [
      '#theme' => 'custom_add_app_form',
      '#user' => $user_id,
      '#content' => $appsList,
      '#cache' => ['max-age' => 0,]
    ];
  }

  /**
   * Sub tab one.
   */
  public function subTabOne() {
    return [
      '#markup' => 'Sub tab one.',
    ];
  }

  /**
   * Sub tab two.
   */
  public function subTabTwo() {
    return [
      '#markup' => 'Sub tab two.',
    ];
  }
}