<?php

namespace App\Http\Controllers;

use App\BoardMember;
use App\Client;
use App\ClientCategories;
use App\EthicalCode;
use App\Event;
use App\FounderSpeech;
use App\HeroSection;
use App\MainOffice;
use App\Message;
use App\NEWS;
use App\Office;
use App\Service;
use App\SocialMedia;
use App\TermsPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller {
    public function index() {
        $services     = Service::all()->take(6);
        $clients      = Client::all();
        $hero_section = HeroSection::first();
            // $title                                    = $hero_section->title;
            // $parts = explode(' ', $title);
            // $first_part = array_shift($parts) . ' ' . array_shift($parts). ' ' . array_shift($parts). ' ' . array_shift($parts). ' ' . array_shift($parts);
            // $second_part = array_shift($parts) . ' ' . array_shift($parts).' ' . array_shift($parts);
            // $last_part = implode(' ', $parts);

            // $hero_section->first_part_of_title = $first_part;
            // $hero_section->middle_part_of_title  = $second_part;
            // $hero_section->last_part_of_title  = $last_part;

                $strip_text = strip_tags($hero_section->description);
                $result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_text);
                $hero_section->formated_description = $result;
    
                $strip_title = strip_tags($hero_section->title);
                $title_result     = preg_replace('/<(\w+)[^>]*>/', '<$1>', $strip_title);
                $hero_section->formated_title = $title_result;



        return view('front.main', compact('services', 'clients', 'hero_section'));
    }
    public function aboutUs() {
        $founder_speach = FounderSpeech::first();
        $board_members  = BoardMember::get();
        return view('front.about', compact('founder_speach', 'board_members'));
    }
    public function termsPolicy() {
        $terms_policies = TermsPolicy::get();
        $ceo = BoardMember::Where('board_member_name','LIKE','%MD. Ferdous Ur Rahman%')->first();
        // dd($ceo);
        return view('front.terms', compact('terms_policies','ceo'));
    }
    public function ethicalCode() {
        $ethical_codes = EthicalCode::get();
        $ceo = BoardMember::Where('board_member_name','LIKE','%MD. Ferdous Ur Rahman%')->first();
        return view('front.ethical_code', compact('ethical_codes','ceo'));
    }
    public function services() {
        $services = Service::with('sub_services')->orderBy('service_precedence', 'asc')->get();
        return view('front.services', compact('services'));
    }
    public function trainingSchool() {
        return view('front.training_school');
    }
    public function ourClients() {
        $client_categories = ClientCategories::with('clients')->get();
        return view('front.our_clients', compact('client_categories'));
    }
    public function newsEvents() {
        $news   = NEWS::get();
        $events = Event::get();
        return view('front.news_events', compact('news', 'events'));
    }
    public function newsDetails(NEWS $news) {
        $related_news = NEWS::where('news_id', '!=', $news->news_id)->take(3)->get();
        return view('front.news_events_details', compact('news', 'related_news'));
    }
    public function eventDetails(Event $event) {
        $related_events = Event::where('event_id', '!=', $event->event_id)->take(3)->get();
        return view('front.news_events_details', compact('event', 'related_events'));
    }
    public function contactUs() {
        $offices = Office::get();
        return view('front.contact_us', compact('offices'));
    }
    public function messageStore(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'    => 'required|max:50',
            'phone'   => 'required|max:50',
            'email'   => 'required|email|max:50',
            'message' => 'required|max:10000',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            $message = Message::create([
                'message_name'        => $request->name,
                'message_email'       => $request->email,
                'message_description' => $request->message,
                'message_contact'     => $request->phone,
            ]);

            $data            = array();
            $data['message'] = 'Message has sent successfully';

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }

    }
    public static function socialMedias() {
        return SocialMedia::all();
    }
    public static function mainOffice() {
        return MainOffice::first();
    }
    public static function allServices() {
        return Service::all();
    }

}
