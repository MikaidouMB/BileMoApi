# BileMoAPI

Project 7 of OpenClassrooms "PHP/Symfony app developper" course.

# Description

BileMo API is webservice exposing an API.

This project aims to developp a REST API to provide mobile phones for clients catalog.
This first version was developped according to the first client needs:

<ul>
    <li>Consult BileMo products</li> 
    <li>Consult product details</li> 
    <li>Consult customers list related to the client</li> 
    <li>Consult customer details related to the client</li> 
    <li>Add a new customer related to a client</li>
    <li>Delete a customer related to a client</li> 
</ul>

API access is restricted to referenced and authenticated clients.

# Environment : Symfony 6 project
Dependencies (require <a href="https://getcomposer.org/">Composer</a>):
<ul>
    <li><a href="https://github.com/FriendsOfSymfony/FOSRestBundle">friendsofsymfony/rest-bundle</a></li>
    <li>ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle</li>
    <li>Nelmio\CorsBundle\NelmioCorsBundle</li>
    <li>Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle</li>
    <li>fzaninotto/faker</li>
</ul>

# Installation

<p><strong>1 - Git clone the project</strong></p>
<pre>
    <code>https://github.com/MikaidouMB/BileMoAPI.git</code>
</pre>

<p><strong>2 - Install libraries</strong></p>
<pre>
    <code>php bin/console composer install</code>
</pre>

<p><strong>3 - Create database</strong></p>
<ul>
    <li>a) Update DATABASE_URL .env file with your database configuration.
        <pre>
            <code>DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name</code>
        </pre>
    </li>
    <li>b) Create database: 
        <pre>
            <code>php bin/console doctrine:database:create</code>
        </pre>
    </li>
    <li>c) Create database structure:
        <pre>
            <code>php bin/console doctrine:schema:update --force</code>
        </pre>
    </li>
    <li>d) Insert fictive data to login
        <pre>
            <code>php bin/console doctrine:fixtures:load</code>
        </pre>
    </li>
</ul>

<p><strong>4 - Create private and public keys with OpenSSL</strong></p>
<pre>
    <code>mkdir -p config/jwt
    openssl genrsa -out config/jwt/private.pem -aes256 4096
    openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
    </code>
    When asking for passphrase, choose one and write it in .env file
    <code>JWT_PASSPHRASE=yourpassphrase</code>
</pre>

# Usage

<p>To test the API, you have first to get an authentication token.</p>
<p>Request with POST method on http://http://127.0.0.1:8000/api/login_check with following data in request JSON body :</p>
<p>For client restricted access :</p>
<p>{
    "username": "useremail@hotmail.com",
    "password": "azerty123456"
}</p>
<p>In response you will obtain a token.</p>
<p>You will then have to add that to following request headers under the key "Authorization" and value "Bearer %token%".</p>



