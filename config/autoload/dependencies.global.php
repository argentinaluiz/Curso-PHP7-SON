<?php

use CodeEdu\FixtureFactory;

use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;
use CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\CampaignRepositoryFactory;
use CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\CustomerRepositoryFactory;

use CodeEmailMKT\Domain\Service\{
    AuthInterface, CampaignEmailSenderInterface, CampaignReportInterface, FlashMessageInterface
};

use CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\TagRepositoryFactory;
use CodeEmailMKT\Infrastructure\Service\{
    AuthServiceFactory, CampaignEmailSenderFactory, CampaignReportFactory, FlashMessageFactory, MailgunFactory
};

use Mailgun\Mailgun;
use Zend\{
    Authentication\AuthenticationService, Expressive\Application, Expressive\Container\ApplicationFactory, Expressive\Helper
};

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            CustomerRepositoryInterface::class => CustomerRepositoryFactory::class,
            TagRepositoryInterface::class => TagRepositoryFactory::class,
            CampaignRepositoryInterface::class => CampaignRepositoryFactory::class,
            FlashMessageInterface::class => FlashMessageFactory::class,
            'doctrine:fixtures_cmd:load' => FixtureFactory::class,
            AuthInterface::class => AuthServiceFactory::class,
            Mailgun::class => MailgunFactory::class,
            CampaignEmailSenderInterface::class => CampaignEmailSenderFactory::class,
            CampaignReportInterface::class => CampaignReportFactory::class,
        ],
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config', //Doctrine needs a service called Configuration
            AuthenticationService::class => 'doctrine.authenticationservice.orm_default'
        ],
    ],
];
