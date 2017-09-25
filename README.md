----------
# XSolve Face Validator Bundle

[![Build Status](https://travis-ci.com/xsolve-pl/xsolve-face-validator-bundle.svg?token=SjQKyns8C8K1pNxxqcyw&branch=master)](https://travis-ci.com/xsolve-pl/xsolve-face-validator-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xsolve-pl/xsolve-face-validator-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xsolve-pl/xsolve-face-validator-bundle/?branch=master)

============================

Table of contents
=================

  * [Introduction](#introduction)
  * [License](#license)
  * [Getting started](#getting-started)
  * [Usage](#usage)

Introduction
=================
This Symfony3 bundle allows to validate whether an image (for instance uploaded by a user of your app) contains person's face.
Internally it uses MS Azure Face API so in order to use it you need an account in MS Azure. In free plan the API allows
to make 30 000 requests per month and 20 per minute so it should be enough to be useful for low traffic apps.

All the following features are configurable on the constraint level and can be easily enabled/disabled:
  * requiring certain face size (ratio to the image size)
  * disallowing an image when the face is covered
  * requiring the hair to be visible (the image must not be cut)
  * allowing the face to be rotated in any of the 3 axes to given level
  * disallowing to wear glasses
  * disallowing to wear sunglasses
  * disallowing any makeup
  * requiring an image not to be blurred over given level (low/medium/high)
  * requiring an image not to contain noises over given level (low/medium/high)

Licence
=================
This library is under the MIT license. See the complete license in [LICENSE](LICENSE) file.

Getting started
=================
Add the bundle to your Symfony3 project using [Composer](https://getcomposer.org/):
```bash
$ composer require face-validator
```

You'll need also to register the bundle in your kernel:
```php
<?php
// app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new XSolve\FaceValidatorBundle\XSolveFaceValidatorBundle(),
        ];
    }
}
```

In the configuration file you must provide your [MS Azure subscription key for Face API](https://azure.microsoft.com/en-us/try/cognitive-services/?api=face-api):

```yml
# app/config/config.yml

xsolve_face_validator:
    azure_subscription_key: your-subscription-key
```

Usage
=================
Check [this documentation](https://symfony.com/doc/current/controller/upload_file.html) if you'd like to know
how to allow users to upload files using Symfony forms and validation.
Assuming in your application you already have some model representing a user (for instance Doctrine entity) and it's
used in a form to gather the data from users and perform validation, it already contains a profile picture:

```php
// src/AppBundle/Entity/User.php

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class User
{
    /**
     * @var UploadedFile
     *
     * @Assert\Image()
     * @Assert\Face()
     */
    public $profilePicture;
}
```

or with YML:
```yml
# src/AppBundle/Resources/config/validation.yml
AppBundle\Entity\User:
    properties:
        profilePicture:
            - Image
            - XSolve\FaceValidatorBundle\Validator\Constraints\Face
```

For other validation config formats please check [dedicated documentation section](http://symfony.com/doc/current/validation.html#constraint-configuration)

Now when executing regular validation, for instance in your controller:
```php
// src/AppBundle/Controller/UserController.php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/user/new", name="app_user_new")
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('profilePicture', FileType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ...
        }

        // ...
    }
}
```

the image will be validated whether it contains a face. The way the face is being validated is customizable, all the possible
options with their default values are shown on the example below:

```php
// src/AppBundle/Entity/User.php

use Symfony\Component\Validator\Constraints as Assert;
use XSolve\FaceValidatorBundle\Validator\Constraints\Face;

class User
{
    /**
     * @var Symfony\Component\HttpFoundation\File\UploadedFile

     * @Assert\Image()
     * @Assert\Face(
     *     minFaceRatio = 0.15,
     *     allowCoveringFace = true,
     *     maxFaceRotation = 20.0,
     *     allowGlasses = true,
     *     allowSunglasses = true,
     *     allowMakeup = true,
     *     allowNoHair = true,
     *     maxBlurLevel = high,
     *     maxNoiseLevel = high,
     *     noFaceMessage = 'Face is not visible.',
     *     faceTooSmallMessage = 'Face is too small.',
     *     faceCoveredMessage = 'Face cannot be covered.',
     *     hairCoveredMessage = 'Hair cannot be covered.',
     *     tooMuchRotatedMessage = 'Face is too much rotated.',
     *     glassesMessage = 'There should be no glasses in the picture.',
     *     sunglassesMessage = 'There should be no sunglasses in the picture.',
     *     makeupMessage = 'The person should not be wearing any makeup.',
     *     blurredMessage = 'The picture is too blurred.',
     *     noiseMessage = 'The picture is too noisy.'
     * )
     */
    public $profilePicture;
}
```

Note that you can omit any (or even all) of the options listed above, then the defaults will be used.

For blur and noise levels the possible options are:
  * low
  * medium
  * high

It's also possible, just like with any other Symfony validator, to use it directly against given value (either file path or an instance of \SplFileInfo).

```php
// src/AppBundle/Controller/ImageController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ImageController extends Controller
{
    public function validateAction(Request $request)
    {
        /* @var $validator ValidatorInterface */
        $validator = $this->get('validator');
        $constraintViolations = $validator->validate(
            '/path/to/your/image/file.png',
            new Face([
                // you can pass the options mentioned before to the validation constraint
            ])
        );
    }
}
```
