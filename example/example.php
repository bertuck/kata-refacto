<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Tools/Tools.php';
require_once __DIR__ . '/../src/Token/Token.php';
require_once __DIR__ . '/../src/Token/DestinationLink.php';
require_once __DIR__ . '/../src/Token/DestinationName.php';
require_once __DIR__ . '/../src/Token/FirstName.php';
require_once __DIR__ . '/../src/Token/LastName.php';
require_once __DIR__ . '/../src/Token/Email.php';
require_once __DIR__ . '/../src/Token/Summary.php';
require_once __DIR__ . '/../src/Token/SummaryHtml.php';
require_once __DIR__ . '/../src/Entity/Entity.php';
require_once __DIR__ . '/../src/Entity/Destination.php';
require_once __DIR__ . '/../src/Entity/Quote.php';
require_once __DIR__ . '/../src/Entity/Site.php';
require_once __DIR__ . '/../src/Entity/Template.php';
require_once __DIR__ . '/../src/Entity/User.php';
require_once __DIR__ . '/../src/Helper/SingletonTrait.php';
require_once __DIR__ . '/../src/Context/ApplicationContext.php';
require_once __DIR__ . '/../src/Repository/Repository.php';
require_once __DIR__ . '/../src/Repository/DestinationRepository.php';
require_once __DIR__ . '/../src/Repository/QuoteRepository.php';
require_once __DIR__ . '/../src/Repository/SiteRepository.php';
require_once __DIR__ . '/../src/TemplateManager.php';

$faker = \Faker\Factory::create();

$template = new Template(
    1,
    'Votre voyage avec une agence locale [quote:destination_name]',
    "
Bonjour [user:first_name] [user:last_name],

Merci d'avoir contacté un agent local pour votre voyage [quote:destination_name].

Voici le lien pour visualiser vôtre voyage : [quote:destination_link].

Vous receverez un mail prochainement sur [user:email].

Reference: [quote:summary].

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
");
$templateManager = new TemplateManager();

$message = $templateManager->getTemplateComputed(
    $template,
    [
        'quote' => new Quote($faker->randomNumber(), $faker->randomNumber(), $faker->randomNumber(), $faker->dateTimeBetween()),
        'user' => new User($faker->randomNumber(), 'Kenni', 'Bertucat', 'test@mail.fr'),
        'site' => new Site($faker->randomNumber(), $faker->url)
    ]
);

echo $message->subject . "\n" . $message->content;
