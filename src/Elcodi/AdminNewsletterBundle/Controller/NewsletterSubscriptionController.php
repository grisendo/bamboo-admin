<?php

/**
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

namespace Elcodi\AdminNewsletterBundle\Controller;

use Exception;
use Mmoreram\ControllerExtraBundle\Annotation\Entity as EntityAnnotation;
use Mmoreram\ControllerExtraBundle\Annotation\Form as FormAnnotation;
use Mmoreram\ControllerExtraBundle\Annotation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

use Elcodi\AdminCoreBundle\Controller\Abstracts\AbstractAdminController;
use Elcodi\AdminCoreBundle\Controller\Interfaces\EnableableControllerInterface;
use Elcodi\CoreBundle\Entity\Abstracts\AbstractEntity;

/**
 * Class Controller for Newsletter
 *
 * @Route(
 *      path = "/newsletter/subscription",
 * )
 */
class NewsletterSubscriptionController
    extends
    AbstractAdminController
    implements
    EnableableControllerInterface
{
    /**
     * List elements of certain entity type.
     *
     * This action is just a wrapper, so should never get any data,
     * as this is component responsability
     *
     * @param Request $request          Request
     * @param integer $page             Page
     * @param integer $limit            Limit of items per page
     * @param string  $orderByField     Field to order by
     * @param string  $orderByDirection Direction to order by
     *
     * @return array Result
     *
     * @Route(
     *      path = "s/{page}/{limit}/{orderByField}/{orderByDirection}",
     *      name = "admin_newsletter_subscription_list",
     *      requirements = {
     *          "page" = "\d*",
     *          "limit" = "\d*",
     *      },
     *      defaults = {
     *          "page" = "1",
     *          "limit" = "50",
     *          "orderByField" = "id",
     *          "orderByDirection" = "DESC",
     *      },
     * )
     * @Template
     * @Method({"GET"})
     */
    public function listAction(
        Request $request,
        $page,
        $limit,
        $orderByField,
        $orderByDirection
    )
    {
        return [
            'page'             => $page,
            'limit'            => $limit,
            'orderByField'     => $orderByField,
            'orderByDirection' => $orderByDirection,
        ];
    }

    /**
     * View element action.
     *
     * This action is just a wrapper, so should never get any data,
     * as this is component responsability
     *
     * @param Request $request Request
     * @param integer $id      Entity id
     *
     * @return array Result
     *
     * @Route(
     *      path = "/{id}",
     *      name = "admin_newsletter_subscription_view",
     *      requirements = {
     *          "id" = "\d*",
     *      }
     * )
     * @Template
     * @Method({"GET"})
     */
    public function viewAction(
        Request $request,
        $id
    )
    {
        return [
            'id' => $id,
        ];
    }

    /**
     * New element action
     *
     * This action is just a wrapper, so should never get any data,
     * as this is component responsability
     *
     * @return array Result
     *
     * @Route(
     *      path = "/new",
     *      name = "admin_newsletter_subscription_new"
     * )
     * @Template
     * @Method({"GET"})
     */
    public function newAction()
    {
        return [];
    }

    /**
     * Save new element action
     *
     * Should be POST
     *
     * @param Request        $request Request
     * @param AbstractEntity $entity  Entity to save
     * @param FormInterface  $form    Form view
     * @param boolean        $isValid Request handle is valid
     *
     * @return RedirectResponse Redirect response
     *
     * @Route(
     *      path = "/save",
     *      name = "admin_newsletter_subscription_save"
     * )
     * @Method({"POST"})
     *
     * @EntityAnnotation(
     *      class = {
     *          "factory" = "elcodi.core.newsletter.factory.newsletter_subscription",
     *      },
     *      persist = true
     * )
     * @FormAnnotation(
     *      class = "elcodi_admin_newsletter_form_type_newsletter_subscription",
     *      name  = "form",
     *      entity = "entity",
     *      handleRequest = true,
     *      validate = "isValid"
     * )
     */
    public function saveAction(
        Request $request,
        AbstractEntity $entity,
        FormInterface $form,
        $isValid
    )
    {
        $this
            ->getManagerForClass($entity)
            ->flush($entity);

        return $this->redirectRoute("admin_newsletter_subscription_view", [
            'id' => $entity->getId(),
        ]);
    }

    /**
     * New element action
     *
     * This action is just a wrapper, so should never get any data,
     * as this is component responsability
     *
     * @param Request $request Request
     * @param integer $id      Entity id
     *
     * @return array Result
     *
     * @Route(
     *      path = "/{id}/edit",
     *      name = "admin_newsletter_subscription_edit"
     * )
     * @Template
     * @Method({"GET"})
     */
    public function editAction(
        Request $request,
        $id
    )
    {
        return [
            'id' => $id,
        ];
    }

    /**
     * Updated edited element action
     *
     * Should be POST
     *
     * @param Request        $request Request
     * @param AbstractEntity $entity  Entity to update
     * @param FormInterface  $form    Form view
     * @param boolean        $isValid Request handle is valid
     *
     * @return RedirectResponse Redirect response
     *
     * @Route(
     *      path = "/{id}/update",
     *      name = "admin_newsletter_subscription_update"
     * )
     * @Method({"POST"})
     *
     * @EntityAnnotation(
     *      class = "elcodi.core.newsletter.entity.newsletter_subscription.class",
     *      mapping = {
     *          "id": "~id~",
     *      }
     * )
     * @FormAnnotation(
     *      class = "elcodi_admin_newsletter_form_type_newsletter_subscription",
     *      name  = "form",
     *      entity = "entity",
     *      handleRequest = true,
     *      validate = "isValid"
     * )
     */
    public function updateAction(
        Request $request,
        AbstractEntity $entity,
        FormInterface $form,
        $isValid
    )
    {
        $this
            ->getManagerForClass($entity)
            ->flush($entity);

        return $this->redirectRoute("admin_newsletter_subscription_view", [
            'id' => $entity->getId(),
        ]);
    }

    /**
     * Enable entity
     *
     * @param Request        $request Request
     * @param AbstractEntity $entity  Entity to enable
     *
     * @return array Result
     *
     * @Route(
     *      path = "/{id}/enable",
     *      name = "admin_newsletter_subscription_enable"
     * )
     * @Method({"GET", "POST"})
     *
     * @EntityAnnotation(
     *      class = "elcodi.core.newsletter.entity.newsletter_subscription.class",
     *      mapping = {
     *          "id" = "~id~"
     *      }
     * )
     * @JsonResponse
     */
    public function enableAction(
        Request $request,
        AbstractEntity $entity
    )
    {
        return parent::enableAction(
            $request,
            $entity
        );
    }

    /**
     * Disable entity
     *
     * @param Request        $request Request
     * @param AbstractEntity $entity  Entity to disable
     *
     * @return array Result
     *
     * @Route(
     *      path = "/{id}/disable",
     *      name = "admin_newsletter_subscription_disable"
     * )
     * @Method({"GET", "POST"})
     *
     * @EntityAnnotation(
     *      class = "elcodi.core.newsletter.entity.newsletter_subscription.class",
     *      mapping = {
     *          "id" = "~id~"
     *      }
     * )
     * @JsonResponse
     */
    public function disableAction(
        Request $request,
        AbstractEntity $entity
    )
    {
        return parent::disableAction(
            $request,
            $entity
        );
    }

    /**
     * Updated edited element action
     *
     * @param Request        $request     Request
     * @param AbstractEntity $entity      Entity to delete
     * @param string         $redirectUrl Redirect url
     *
     * @return RedirectResponse Redirect response
     *
     * @Route(
     *      path = "/{id}/delete",
     *      name = "admin_newsletter_subscription_delete"
     * )
     * @Method({"GET"})
     *
     * @EntityAnnotation(
     *      class = "elcodi.core.newsletter.entity.newsletter_subscription.class",
     *      mapping = {
     *          "id" = "~id~"
     *      }
     * )
     * @JsonResponse
     */
    public function deleteAction(
        Request $request,
        AbstractEntity $entity,
        $redirectUrl = null
    )
    {
        return parent::deleteAction(
            $request,
            $entity
        );
    }
}
