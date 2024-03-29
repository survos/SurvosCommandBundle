# Command Bundle

Run Symfony command line programs from a web interface, for easier debugging.

## Purpose

Use assert(), dump() and dd() are quick and easy debug tools when debugging a Symfony web page.  But it's often difficult to use with console commands.

For example, in the official Symfony Demo, there is a command to send the list of users to an email  address.

```bash
bin/console app:list-users --send-to=admin@example.com
```

Debugging this is much easier with Symfony's Debug Toolbar, so make it available by adding this bundle.

```bash
composer req survos/command-bundle
```

Now go to /admin/commands and see what's available

![img.png](img.png)

Select list-users, and fill in the email.

![img_1.png](img_1.png)

Submit the form and open the debug toolbar:

![img_2.png](img_2.png)

With dumps and asserts, this is even more helpful.



## Example with Symfony Demo

```bash
symfony new --demo command-demo && cd command-demo
# bump to the latest version of Symfony 6.3, use whatever version of you have installed
git clone git@github.com:tacman/symfony-demo.git
sed -i 's/"php": "8.1.0"//' composer.json 
sed -i 's/"require": "6.3.*"/"require": "^6.4"/' composer.json
composer config minimum-stability dev
composer config extra.symfony.allow-contrib true
composer update 
composer req survos/command-bundle
bin/console --version

yarn install && yarn dev
symfony server:start -d
symfony open:local  --path admin/commands
```

## Example with a new 6.4 Project and Bootstrap (no build step)

```bash
symfony new command-64 --webapp && cd command-64 
composer config minimum-stability dev
composer config extra.symfony.allow-contrib true
sed -i 's/"php": "8.1.0"//' composer.json 
composer req symfony/asset-mapper:^6.4
composer req symfony/stimulus-bundle:2.x-dev
bin/console make:controller -i AppController
symfony server:start -d
symfony open:local --path=/app
bin/console --version

composer req survos/command-bundle
bin/console make:command app:test
bin/console make:command app:import

# make it prettier with bootstrap, but not necessary
bin/console importmap:require bootstrap
echo "import 'bootstrap/dist/css/bootstrap.min.css'" >> assets/app.js

cat > config/packages/twig.yaml << END
twig:
    default_path: '%kernel.project_dir%/templates'
    form_themes:
        - 'bootstrap_5_layout.html.twig'
        - 'bootstrap_5_horizontal_layout.html.twig'

when@test:
    twig:
        strict_variables: true
END

symfony server:start -d
symfony open:local  --path admin/commands
```

## Example with Symfony 7
## Example with a new 6.4 Project and Bootstrap (no build step)

```bash
symfony new test-7 --version=next --php=8.2 && cd test-7
sed -i 's/"6.4.*"/"^7.0"/' composer.json
composer config minimum-stability dev
composer config prefer-stable false
composer config extra.symfony.allow-contrib true
composer update
composer config repositories.knp_menu_bundle '{"type": "vcs", "url": "git@github.com:tacman/KnpMenuBundle.git"}'
composer require knplabs/knp-menu-bundle
composer req survos/bootstrap-bundle
composer req symfony/maker-bundle symfony/debug-bundle --dev
bin/console make:controller -i AppController
symfony server:start -d
symfony open:local --path=/app

composer require --dev symfony/profiler-pack

composer req doctrine/orm:^2.16-dev doctrine/doctrine-bundle:^2.11-dev symfony/twig-bundle -w
composer require stof/doctrine-extensions-bundle:^1.8



composer req symfony/maker-bundle symfony/debug-bundle --dev
bin/console make:controller -i AppController
symfony server:start -d
symfony open:local --path=/app

echo "DATABASE_URL=sqlite:///%kernel.project_dir%/var/data.db" > .env.local
symfony new command-7 --webapp --version=next --php=8.2 && cd command-7
composer config repositories.knp_menu_bundle '{"type": "vcs", "url": "git@github.com:tacman/KnpMenuBundle.git"}'
composer require knplabs/knp-menu-bundle

composer req zenstruck/console-extra
composer req survos/command-bundle
composer req symfony/asset-mapper:^6.4
composer req symfony/stimulus-bundle:2.x-dev
bin/console make:controller -i AppController
symfony server:start -d
symfony open:local --path=/app
bin/console --version


Now go to /admin/commands

## Using Invokable Commands

I love zenstruck's extra-console, which allows defining the arguments and options via attributes, so you can create smaller console commands.  This bundle (command-bundle) already uses extra-console, so this works with no further installation.

Here's a command that lists the posts.

```bash
cat > src/Command/ListPostsCommand.php <<END
<?php

namespace App\Command;

use App\Entity\Post;
use App\Entity\Tag;
use App\Repository\PostRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Zenstruck\Console\Attribute\Option;
use Zenstruck\Console\ConfigureWithAttributes;
use Zenstruck\Console\InvokableServiceCommand;
use Zenstruck\Console\IO;
use Zenstruck\Console\RunsCommands;
use Zenstruck\Console\RunsProcesses;

#[AsCommand('app:list-posts', 'List the posts')]
final class ListPostsCommand extends InvokableServiceCommand
{

    use ConfigureWithAttributes;
    use RunsCommands;
    use RunsProcesses;


    public function __invoke(
        IO                        $io,
        PostRepository            $postRepository,
        PropertyAccessorInterface $accessor,
        StyleInterface $symfonyStyle,
        #[Option(description: 'Limit the number of posts')]
        int                       $limit = 50
    ): void
    {

        $headers = ['id', 'title', 'author', 'tags', 'comments'];
        $createUserArray = static function (Post $post) use ($headers, $accessor) {
            //
            return array_map(fn($header) => match ($header) {
                'author' => $post->getAuthor()->getFullName(),
                'tags' => join(',', $post->getTags()->map(fn(Tag $tag) => $tag->getName())->toArray()),
                'comments' => $post->getComments()->count(),
                default => $accessor->getValue($post, $header)
            }, $headers);
        };

        $criteria = [];
        $posts = array_map($createUserArray, $postRepository->findBy($criteria, [], $limit));
        $symfonyStyle->table($headers, $posts);
    }
}
END
```

## with castor

```bash
symfony new castor-command-demo --webapp && cd castor-command-demo
sed -i "s|# MAILER_DSN|MAILER_DSN|" .env
bin/console make:command app:castor-test
cat > castor.php <<'END'
<?php

use Castor\Attribute\AsTask;

use function Castor\io;
use function Castor\capture;
use function Castor\import;

import(__DIR__ . '/src/Command/CastorTestCommand.php');

#[AsTask(description: 'Welcome to Castor!')]
function hello(): void
{
    $currentUser = capture('whoami');

    io()->title(sprintf('Hello %s!', $currentUser));
}
END


```

Add attribute to AppCastorTest.php

```php
#[\Castor\Attribute\AsSymfonyTask()]
```

```bash
castor list
```

