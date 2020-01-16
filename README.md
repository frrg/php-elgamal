# php-elgamal
elgamal encryption in php


text    = text that you want to encrypt.

p       = prime number > 255 . as private key

g       = random number,   0 < g < p

x       = random number, 0 < x < p . as private key

USAGE

# encrypt()

convert plaintext to ciphertext 

required text(string),p(int),g(int) 

example:

$test = new elgamal();

$test->text = 'this is text';

$test->p = 257; 

$test->g = 100; 

$test->encrypt();


# getKey()

get public key

required g(int),x(int),p(int)


example:

$test = new elgamal();

$test->g = 100; 

$test->x = 50; 

$test->p = 257; 

$test->getKey();


# decrypt()

convert ciphertext to plaintext

required cipher(array),p(int),x(int)


example

$test = new elgamal();

$test->cipher = [fill with cipher text]; 

$test->x = 50; 

$test->p = 257;

$test->decrypt(); 



