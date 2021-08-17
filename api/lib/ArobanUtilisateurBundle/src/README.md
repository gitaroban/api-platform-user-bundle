# Utilisateur Bundle

UtilisateurBundle est le bundle Aroban qui permet d'apporter
les fonctionnalités minimales pour l'authentification des
utilisateurs dans un projet.

## Installation

```console
composer require gitaroban/utilisateur-bundle
```

Le bundle n'utilise pas Symfony Flex, donc vous devrez activer manuellement le bundle.

```php
// config/bundles.php
return [
    // ...
    Aroban\Bundle\UtilisateurBundle\UtilisateurBundle::class => ['all' => true],
];
```

## Configuration

### Activation du Data Persister

Avec une priorité supérieur au DoctrineDataPersister (donc exécuté avant).
```yaml
# config/services.yaml
services:
    # Active le Data Persister du bundle (hash de mot de passe + création automatique d'un ApiToken)
    Aroban\Bundle\UtilisateurBundle\DataPersister\ArobanUtilisateurDataPersister:
        tags: 
            - { name: api_platform.data_persister, priority: -500 }
```

Ou plus simplement.
```yaml
# config/services.yaml
services:
    # Active le Data Persister du bundle (hash de mot de passe + création automatique d'un ApiToken)
    Aroban\Bundle\UtilisateurBundle\DataPersister\ArobanUtilisateurDataPersister: ~
```

### Activation du ApiTokenAuthenticator

Le repository Utilisateur de l'application doit implémenter l'interface ```ArobanUtilisateurRepositoryInterface```
```php
// exemple de code

//...
class UtilisateurRepository implements ArobanUtilisateurRepositoryInterface
{
    //...
    
    public function fetchByToken(string $token): ?Utilisateur
    {
        return $this->createQueryBuilder('u')
            ->select('u')
            ->join(ApiToken::class, 'at', Join::WITH, 'at.utilisateur = u')
            ->andWhere('at.token = :token')
            ->andWhere('at.expiresAt >= :expiresAt')
            ->setParameter('token', $token)
            ->setParameter('expiresAt', new \DateTime())
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //...
}
```


```yaml
# config/packages/security.yaml
security:
    firewalls:
        main:
            custom_authenticator: Aroban\Bundle\UtilisateurBundle\Security\ApiTokenAuthenticator
```

```yaml
# config/services.yaml
services:
    # Active le service de vérification d'authentification par ApiToken
    Aroban\Bundle\UtilisateurBundle\Security\ApiTokenAuthenticator: ~

    # Permet de vérifier l'authentification d'un utilisateur en utilisant un token.
    Aroban\Bundle\UtilisateurBundle\Repository\ArobanUtilisateurRepositoryInterface: '@App\Repository\UtilisateurRepository'
```

### Activation du SecurityController

```yaml
# config/routes/aroban_utilisateur.yaml
_aroban_utilisateur:
    resource: '@UtilisateurBundle/Resources/config/routes.xml'
```

```yaml
# config/packages/security.yaml
security:
    firewalls:
        main:
            json_login:
                check_path: aroban_login
            logout:
                path: aroban_logout
```

## Contribution

La contribution est limitée aux collaborateurs Aroban.
Si vous souhaitez voir une nouvelle fonctionnalité, vous pouvez la demander
mais créer une pull request est un meilleur moyen de l'obtenir.

Vous pouvez également soumettre une issue : toutes les contributions et questions sont appréciées :).
