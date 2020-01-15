<?php

class xkomper13
{

    function is_prime($number)
    {
        // 1 is not prime
        if ($number == 1) {
            return false;
        }
        // 2 is the only even prime number
        if ($number == 2) {
            return true;
        }
        // square root algorithm speeds up testing of bigger prime numbers
        $x = sqrt($number);
        $x = floor($x);
        for ($i = 2; $i <= $x; ++$i) {
            if ($number % $i == 0) {
                break;
            }
        }

        if ($x == $i - 1) {
            return true;
        } else {
            return false;
        }
    }

    function getKunciPublic()
    {
        //todo mendapatkan kunci publik
        return  bcpowmod($this->g,$this->x,$this->p); 
    }

    function pecahString()
    {
        //todo memecah teks menjadi array
        return str_split($this->text);
    }
    function getAscii()
    {
        foreach ($this->pecahString() as $pecahan) {
            $ascii[] = ord($pecahan);
        }
        return $ascii;
    }
    function cipher()
    {
        //menggabungkan 2 rumus menjadi 1
        foreach ($this->getAscii() as $m) {
            $k = $this->getK($m);
            // $gamma = ;
            // $delta = new BigInteger();
            // $gamma = pow($this->g,$k) %$this->p;
            $gamma = bcpowmod($this->g,$k, $this->p);
            $delta = bcmod(bcmul(bcpow($this->getKunciPublic(),$k) ,$m), $this->p);
            $gabungperhuruf[] = $gamma . ',' . $delta;
        }
        //gabung semua huruf
        $gabung1 = implode(',', $gabungperhuruf);
        return $gabung1;
    }

    function plaintext($string,$x)
    {
        $semua = explode(',', $string);
        for($i=0; $i<=(count($semua)-1); $i++){
            if($i % 2 != 0){
                $delta[] = $semua[$i]; //indeks ganjil
            } else {
                $gamma[] = $semua[$i]; // indeks genap
            }
        }
        $pangkat = $this->p - 1 - $this->x;
        for($i=0; $i<count($gamma); $i++){

            $xxxx[] = chr(bcmod(bcmul($delta[$i],bcpow($gamma[$i],$pangkat)),$this->p));
        }
        
        return implode('',$xxxx);
    }
    function getK()
    {
        return rand(1, ($this->p - 1)); //random number
    }
    function tod()
    {
        if (!$this->is_prime($this->p)) {
            echo "[+] Pastikan kolom bilangan prima adalah bilangan prima\n";
            exit("keluar");
        }

        print "[+] mendapatkan kunci publik -->";
        print $this->getKunciPublic();
        print "\n";

        print '[+] memecah string --->';
        print(implode(',',$this->pecahString()));
        print "\n";

        print "[+] mendapatkan ascii --->";
        print(implode(',',$this->getAscii()));
        print "\n";
        $cipher = $this->cipher();
        print '[+] mendapatkan cipher text --->' . $cipher;
        print "\n";
        print "[+] mengubah cipher ke teks-->";
        print_r($this->plaintext($cipher,$this->x));
        print "\n";
    }
}


$elgamal = new xkomper13();
// =========================== setting input ================= //
$elgamal->p = 293; //bilangan prima lebih dari 255 //privat
$elgamal->g = 20; //bilangan bulat harus kurang dari p
$elgamal->x = 290; //random number //privat
$elgamal->text = 'feri ganteng sekali'; //plain text
// =========================== setting input ================= //
$elgamal->tod();