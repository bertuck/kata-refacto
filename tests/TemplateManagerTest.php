<?php
use PHPUnit\Framework\TestCase;

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

class TemplateManagerTest extends TestCase
{
    /**
     * Init the mocks
     */
    public function setUp()
    {
    }

    /**
     * Closes the mocks
     */
    public function tearDown()
    {
    }

    /**
     * @test
     */
    public function test()
    {
        $faker = \Faker\Factory::create();

        $expectedDestination = DestinationRepository::getInstance()->getById($faker->randomNumber());
        $expectedUser = ApplicationContext::getInstance()->getCurrentUser();

        $quote = new Quote($faker->randomNumber(), $faker->randomNumber(), $faker->randomNumber(), $faker->dateTimeBetween());

        $template = new Template(
            1,
            'Votre voyage avec une agence locale [quote:destination_name]',
            "
Bonjour [user:first_name],

Merci d'avoir contacté un agent local pour votre voyage [quote:destination_name].

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
");
        $templateManager = new TemplateManager();
        $expectedDestination = DestinationRepository::getInstance()->getById($faker->randomNumber());
        $expectedUser = ApplicationContext::getInstance()->getCurrentUser();

        $quote = new Quote($faker->randomNumber(), $faker->randomNumber(), $faker->randomNumber(), $faker->dateTimeBetween());
        $site = new Site($faker->randomNumber(), $faker->url);
        $message = $templateManager->getTemplateComputed(
            $template,
            [
                'quote' => $quote,
                'user' => $expectedUser,
                'site' => $site,
            ]
        );

        $this->assertEquals('Votre voyage avec une agence locale ' . $expectedDestination->getCountryName(), $message->subject);
        $this->assertEquals("
Bonjour " . $expectedUser->getFirstname() . ",

Merci d'avoir contacté un agent local pour votre voyage " . $expectedDestination->getCountryName() . ".

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
", $message->content);

    }

}
