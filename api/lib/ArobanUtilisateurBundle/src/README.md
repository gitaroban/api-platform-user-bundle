# Utilisateur Bundle

UtilisateurBundle est le bundle Aroban qui permet d'apporter
les fonctionnalités minimales pour l'authentification des
utilisateurs dans un projet.

## Installation

```console
composer require gitaroban/utilisateur-bundle
```

Et... c'est tout !

Si vous *n'utilisez pas* Symfony Flex, vous devrez également activer le bundle.

```php
// config/bundles.php

return [
    // ...
    Aroban\Bundle\UtilisateurBundle\UtilisateurBundle::class => ['all' => true],
];
```

## Configuration

```yaml
# config/services.yaml
services:

    # Active le Data Persister du bundle (hash de mot de passe + création automatique d'un ApiToken)
    Aroban\Bundle\UtilisateurBundle\DataPersister\ArobanUtilisateurDataPersister: ~
```

## Contribution

La contribution est limitée aux collaborateurs Aroban.
Si vous souhaitez voir une nouvelle fonctionnalité, vous pouvez la demander
mais créer une pull request est un meilleur moyen de l'obtenir.

Vous pouvez également soumettre une issue : toutes les contributions et questions sont appréciées :).
