<?php

namespace Drupal\my_config\Form;

use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description of ConfigForm
 *
 * @author amir
 */
class ConfigForm extends FormBase
{
    public function getFormId() {
        return 'my_config_form';
    }
    
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['social_bookmarks'] = array(
            '#type' => 'details',
            '#title' => $this->t('Social Bookmarks'),
            '#open' => TRUE,
        );

        $form['social_bookmarks']['facebook'] = array(
            '#type' => 'url',
            '#title' => $this->t('Facebook'),
            '#default_value' => \Drupal::config('my_config.config.social')->get('facebook'),
        );

        $form['social_bookmarks']['twitter'] = array(
            '#type' => 'url',
            '#title' => $this->t('Twitter'),
            '#default_value' => \Drupal::config('my_config.config.social')->get('twitter'),
        );

        $form['social_bookmarks']['gplus'] = array(
            '#type' => 'url',
            '#title' => $this->t('Google Plus'),
            '#default_value' => \Drupal::config('my_config.config.social')->get('gplus'),
        );

        $form['social_bookmarks']['youtube'] = array(
            '#type' => 'url',
            '#title' => $this->t('YouTube'),
            '#default_value' => \Drupal::config('my_config.config.social')->get('youtube'),
        );

        $form['social_bookmarks']['instagram'] = array(
            '#type' => 'url',
            '#title' => $this->t('Instagram'),
            '#default_value' => \Drupal::config('my_config.config.social')->get('instagram'),
        );

        $form['actions']['#type'] = 'actions';

        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Save'),
            '#button_type' => 'primary',
        );

        return $form;
    }
    
    public function validateForm(array &$form, FormStateInterface $form_state) 
    {
        $facebookPageUrl = $form_state->getValue('facebook');
        $twitterAccountUrl = $form_state->getValue('twitter');
        $gplusPageUrl = $form_state->getValue('gplus');
        $youtubeAccountUrl = $form_state->getValue('youtube');
        $instagramAccountUrl = $form_state->getValue('instagram');

        if(!empty($facebookPageUrl) && !UrlHelper::isValid($facebookPageUrl,true)){
            $form_state->setErrorByName('facebook', $this->t('The Facebook page URL you entered is not a valid. Please enter a valid URL.'));
        }

        if(!empty($twitterAccountUrl) && !UrlHelper::isValid($twitterAccountUrl,true)){
            $form_state->setErrorByName('twitter', $this->t('The Twitter account page URL you entered is not a valid. Please enter a valid URL.'));
        }

        if(!empty($gplusPageUrl) && !UrlHelper::isValid($gplusPageUrl,true)){
            $form_state->setErrorByName('gplus', $this->t('The Google Plus page URL you entered is not a valid. Please enter a valid URL.'));
        }

        if(!empty($youtubeAccountUrl) && !UrlHelper::isValid($youtubeAccountUrl,true)){
            $form_state->setErrorByName('youtube', $this->t('The YouTube account page URL you entered is not a valid. Please enter a valid URL.'));
        }

        if(!empty($instagramAccountUrl) && !UrlHelper::isValid($instagramAccountUrl,true)){
            $form_state->setErrorByName('instagram', $this->t('The Instagram Account page URL you entered is not a valid. Please enter a valid URL.'));
        }
    }

  
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $facebookPageUrl = $form_state->getValue('facebook');
        $twitterAccountUrl = $form_state->getValue('twitter');
        $gplusPageUrl = $form_state->getValue('gplus');
        $youtubeAccountUrl = $form_state->getValue('youtube');
        $instagramAccountUrl = $form_state->getValue('instagram');

        \Drupal::configFactory()->getEditable('my_config.config.social')->set('facebook', $facebookPageUrl)->save();
        \Drupal::configFactory()->getEditable('my_config.config.social')->set('twitter', $twitterAccountUrl)->save();
        \Drupal::configFactory()->getEditable('my_config.config.social')->set('gplus', $gplusPageUrl)->save();
        \Drupal::configFactory()->getEditable('my_config.config.social')->set('youtube', $youtubeAccountUrl)->save();
        \Drupal::configFactory()->getEditable('my_config.config.social')->set('instagram', $instagramAccountUrl)->save();

        drupal_set_message($this->t('Configuration Saved'));
    }
}
