<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Boutique — Backend (Laravel)

Présentation /

Ce projet est le backend d'une application de gestion de boutique. Il permet d’administrer des catégories, des produits et des acheteurs.

Il a été réalisé dans le cadre de l'examen CCP 2026, avec le formateur M. Tine.

C'est une application qui permet de :
    . Gérer les catégories (qui contientent plusieurs produits.)
    . Gérer les produits (Un produit appartient à une catégorie)
    . Gérer les acheteurs (Un acheteur peut acheter plusieurs produits ; un produit peut être acheté par plusieurs
    acheteurs.)
    . Gérer les achats (La fiche d’un acheteur affiche l’historique de ses achats)
    . Les utilisateurs selon leur rôle (Employe, Gestionnaire et Admin)

    Le backend est développé avec Laravel et expose une API REST utilisée par une application React.


## Technologies utilisées:

    Laravel
    PHP
    MySQL
    Swagger
    API RESRT


## Comment installer le projet ?

Cloner le projet
```bash
git clone "https://github.com/Dieynabahamadymarigo/boutique-backend-KhadimNguer-DieynabaHamadyMarigo.git"
```
Entre dans le projet
```bash
cd boutique
```
Installer les dépendances
```bash
composer install
```

Configurer la base données ddans le fichier .env
Exécuter les migrations et les données de démonstration

```bash
php artisan migrate --seed
```

Lancer le serveur
```bash
composer run dev ou php artisan serve
```

## Comptes de test
Rôle         Email              Mot de passe
Admin => admin@boutique.com => password123
Gestionnaire=>gestionnaire@boutique.com=>password123
Employe=>employe@boutique.com=>password123

## Fonctionnalités

=> Authentification
=> Gestion des catégories
=> Gestion des produits
=> Gestion des acheteurs
=> Enregistrer les achats
=> Gestion des rôles
=> API REST
=> Documentation Swagger


## API

L'API est disponible à l'adresse :

```bash
http://127.0.0.1:8000/api/documentation#/
```
La documentation Swagger est accessible depuis l'application.

## Auteur

Projet réalisé par :
HAMADY MARIGO Dieynaba
NGUER Khadim
