<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($bot, $message) {
            if ($message == '1') {
                $bot->startConversation(new OnboardingConversation);
            } elseif ($message == '2') {
                $bot->reply('<a href="https://wa.me/6282397032649?text=Hi+Admin.+Saya+ingin+bertanya+mengenai+PDAM" target="blank_">Klik Link Ini Untuk Memulai Chat Whatsapp</a>');
                $bot->reply("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
            } else {
                $bot->reply("Pilihan Anda Salah, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
            }
        });

        $botman->listen();
    }
}

class OnboardingConversation extends Conversation
{
    protected $pilihan;

    protected $layanan;

    public function pilihanMenu()
    {
        $this->ask('Pilihan : <br> 1. Apa Itu PDAM <br> 2. Pelayanan PDAM Gowa', function (Answer $answer) {
            $this->pilihan = $answer->getText();

            if ($this->pilihan == '1') {
                $this->say('PDAM Adalah...');
                $this->say("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
            } elseif ($this->pilihan == '2') {
                $this->pilihanLayanan();
            } else {
                $this->say("Pilihan Anda Salah");
                $this->pilihanMenu();
            }
        });
    }

    public function pilihanLayanan()
    {
        $this->ask('Pilihan : <br> 1. Pelayanan Tangki Air <br> 2. Sambungan Baru', function (Answer $answer) {
            $this->layanan = $answer->getText();

            if ($this->layanan == '1') {
                $this->say('Pelayanan Tangki Air...');
                $this->say("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
            } elseif ($this->layanan == '2') {
                $this->say('Sambungan Baru...');
                $this->say("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
            } else {
                $this->say("Pilihan Anda Salah");
                $this->pilihanLayanan();
            }
        });
    }

    public function run()
    {
        $this->pilihanMenu();
    }
}
