<?php

namespace Drupal\consumer;
use Twig\TwigFunction;


/**
 * extend Drupal's Twig_Extension class
 */
class TwigExtension extends \Twig_Extension {

  public function getFunctions() {
    return [
      'testfunc' => new TwigFunction('testfunc', ['Drupal\consumer\TwigExtension', 'testFunction']),
    ];
  }

  /**
   * {@inheritdoc}
   * Let Drupal know the name of your extension
   * must be unique name, string
   */
  public function getName() {
    return 'consumer.customtwigextension';
  }


  public static function testFunction($upperCase = FALSE) {
    return \Drupal::currentUser()->id();
  }
}