<?php

use App\Modal\Booking;
use App\Modal\Hall;
use App\Modal\HallFeature;
use App\Modal\HallFeedback;
use App\Modal\HallFood;
use App\Modal\HallTime;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        {
            $admin = new User();
            $admin->name = "admin";
            $admin->email = "admin@demo.com";
            $admin->password = Hash::make('password');
            $admin->location = 'lahore';
            $admin->phone_number = '00000000000';
            $admin->cnic = '0000000000000';
            $admin->role = 'admin';
            $admin->save();

            $customer1 = new User();
            $customer1->name = "customer1";
            $customer1->email = "customer1@demo.com";
            $customer1->password = Hash::make('password');
            $customer1->location = 'lahore';
            $customer1->phone_number = '00000000000';
            $customer1->cnic = '0000000000000';
            $customer1->role = 'customer';
            $customer1->save();

            $customer2 = new User();
            $customer2->name = "customer2";
            $customer2->email = "customer2@demo.com";
            $customer2->password = Hash::make('password');
            $customer2->location = 'lahore';
            $customer2->phone_number = '00000000000';
            $customer2->cnic = '0000000000000';
            $customer2->role = 'customer';
            $customer2->save();

            $customer3 = new User();
            $customer3->name = "customer3";
            $customer3->email = "customer3@demo.com";
            $customer3->password = Hash::make('password');
            $customer3->location = 'pakistan';
            $customer3->phone_number = '00000000000';
            $customer3->cnic = '0000000000000';
            $customer3->role = 'customer';
            $customer3->save();

            $customer4 = new User();
            $customer4->name = "customer4";
            $customer4->email = "customer4@demo.com";
            $customer4->password = Hash::make('password');
            $customer4->location = 'lahore';
            $customer4->phone_number = '00000000000';
            $customer4->cnic = '0000000000000';
            $customer4->role = 'customer';
            $customer4->save();

            $customer5 = new User();
            $customer5->name = "customer5";
            $customer5->email = "customer5@demo.com";
            $customer5->password = Hash::make('password');
            $customer5->location = 'karachi';
            $customer5->phone_number = '00000000000';
            $customer5->cnic = '0000000000000';
            $customer5->role = 'customer';
            $customer5->save();

            $hall_manager1 = new User();
            $hall_manager1->name = "hall_manager1";
            $hall_manager1->email = "hall_manager1@demo.com";
            $hall_manager1->password = Hash::make('password');
            $hall_manager1->location = 'lahore';
            $hall_manager1->phone_number = '00000000000';
            $hall_manager1->cnic = '0000000000000';
            $hall_manager1->role = 'hall_manager';
            $hall_manager1->is_approved = true;
            $hall_manager1->save();

            $hall_manager2 = new User();
            $hall_manager2->name = "hall_manager2";
            $hall_manager2->email = "hall_manager2@demo.com";
            $hall_manager2->password = Hash::make('password');
            $hall_manager2->location = 'pakistan';
            $hall_manager2->phone_number = '00000000000';
            $hall_manager2->cnic = '0000000000000';
            $hall_manager2->role = 'hall_manager';
            $hall_manager2->save();

            $hall_manager3 = new User();
            $hall_manager3->name = "hall_manager3";
            $hall_manager3->email = "hall_manager3@demo.com";
            $hall_manager3->password = Hash::make('password');
            $hall_manager3->location = 'karachi';
            $hall_manager3->phone_number = '00000000000';
            $hall_manager3->cnic = '0000000000000';
            $hall_manager3->role = 'hall_manager';
            $hall_manager3->save();

            $hall_manager4 = new User();
            $hall_manager4->name = "hall_manager4";
            $hall_manager4->email = "hall_manager4@demo.com";
            $hall_manager4->password = Hash::make('password');
            $hall_manager4->location = 'lahore';
            $hall_manager4->phone_number = '00000000000';
            $hall_manager4->cnic = '0000000000000';
            $hall_manager4->role = 'hall_manager';
            $hall_manager4->save();

            $hall1 = new Hall();
            $hall1->user_id = 7;
            $hall1->name = "hall1";
            $hall1->description = "hall1 best hall.";
            $hall1->hall_size = 100;
            $hall1->event_type = 'mariage';
            $hall1->hall_rent = 130;
            $hall1->location = 'lahore';
            $hall1->min_no_of_persons = 4;
            $hall1->open_time = '23:11';
            $hall1->closed_time = '17:10';
            $hall1->is_available = true;
            $hall1->save();

            $hall = new Hall();
            $hall->user_id = User::all()->random()->id;
            $hall->name = "hall2";
            $hall->description = "hall2 best hall.";
            $hall->hall_size = 100;
            $hall->event_type = 'mariage';
            $hall->hall_rent = 130;
            $hall->location = 'lahore';
            $hall->min_no_of_persons = 4;
            $hall->open_time = '23:11';
            $hall->closed_time = '17:10';
            $hall->is_available = true;
            $hall->save();

            $hall = new Hall();
            $hall->user_id = User::all()->random()->id;
            $hall->name = "hall3";
            $hall->description = "hall3 best hall.";
            $hall->hall_size = 100;
            $hall->event_type = 'mariage';
            $hall->hall_rent = 90;
            $hall->location = 'pakistan';
            $hall->min_no_of_persons = 4;
            $hall->open_time = '23:11';
            $hall->closed_time = '17:10';
            $hall->is_available = false;
            $hall->save();

            $hall = new Hall();
            $hall->user_id = User::all()->random()->id;
            $hall->name = "hall4";
            $hall->description = "hall4 best hall.";
            $hall->hall_size = 100;
            $hall->event_type = 'mariage';
            $hall->hall_rent = 60;
            $hall->location = 'karachi';
            $hall->min_no_of_persons = 4;
            $hall->open_time = '23:11';
            $hall->closed_time = '17:10';
            $hall->is_available = true;
            $hall->save();

            $hall = new Hall();
            $hall->user_id = User::all()->random()->id;
            $hall->name = "hall4";
            $hall->description = "hall4 best hall.";
            $hall->hall_size = 100;
            $hall->event_type = 'mariage';
            $hall->hall_rent = 60;
            $hall->location = 'karachi';
            $hall->min_no_of_persons = 4;
            $hall->open_time = '23:11';
            $hall->closed_time = '17:10';
            $hall->is_available = true;
            $hall->save();

            $booking = new Booking();
            $booking->user_id = User::all()->random()->id;
            $booking->hall_id = Hall::where('is_available', 1)->get()->random()->id;
            $booking->event_type = "mariage";
            $booking->no_of_persons = rand(1, 100);
            $booking->booking_date = Carbon::now();
            $booking->book_time_from = Carbon::now()->addDays(1);
            $booking->book_time_to = Carbon::now()->addDays(4);
            $booking->menu = 'Food Menu';
            $booking->price = 190;
            $booking->save();

            $booking = new Booking();
            $booking->user_id = User::all()->random()->id;
            $booking->hall_id = Hall::where('is_available', 1)->get()->random()->id;
            $booking->event_type = "mariage";
            $booking->no_of_persons = rand(1, 100);
            $booking->booking_date = Carbon::now();
            $booking->book_time_from = Carbon::now()->addDays(1);
            $booking->book_time_to = Carbon::now()->addDays(4);
            $booking->menu = 'Food Menu';
            $booking->price = 290;
            $booking->save();

            $booking = new Booking();
            $booking->user_id = User::all()->random()->id;
            $booking->hall_id = Hall::where('is_available', 1)->get()->random()->id;
            $booking->event_type = "mariage";
            $booking->no_of_persons = rand(1, 100);
            $booking->booking_date = Carbon::now();
            $booking->book_time_from = Carbon::now()->addDays(1);
            $booking->book_time_to = Carbon::now()->addDays(4);
            $booking->menu = 'Food Menu';
            $booking->price = 90;
            $booking->save();

            $feedback = new HallFeedback();
            $feedback->booking_id = Booking::all()->random()->id;
            $feedback->user_id = User::all()->random()->id;
            $feedback->hall_id = Hall::where('is_available', 1)->get()->random()->id;;
            $feedback->feedback = "feedback";
            $feedback->rating = 5;
            $feedback->save();

            $feedback = new HallFeedback();
            $feedback->booking_id = Booking::all()->random()->id;
            $feedback->user_id = User::all()->random()->id;
            $feedback->hall_id = Hall::where('is_available', 1)->get()->random()->id;;
            $feedback->feedback = "feedback";
            $feedback->rating = 5;
            $feedback->save();

            $feedback = new HallFeedback();
            $feedback->booking_id = Booking::all()->random()->id;
            $feedback->user_id = User::all()->random()->id;
            $feedback->hall_id = Hall::where('is_available', 1)->get()->random()->id;;
            $feedback->feedback = "feedback";
            $feedback->rating = 5;
            $feedback->save();

            $feedback = new HallFeedback();
            $feedback->booking_id = Booking::all()->random()->id;
            $feedback->user_id = User::all()->random()->id;
            $feedback->hall_id = Hall::where('is_available', 1)->get()->random()->id;;
            $feedback->feedback = "feedback";
            $feedback->rating = 5;
            $feedback->save();

            $hallFood = new HallFood();
            $hallFood->hall_id = $hall1->id;
            $hallFood->title = "Salad";
            $hallFood->price = 120;
            $hallFood->is_available = true;
            $hallFood->save();

            $hallFood = new HallFood();
            $hallFood->hall_id = $hall1->id;
            $hallFood->title = "chiken";
            $hallFood->price = 420;
            $hallFood->is_available = true;
            $hallFood->save();

            $hallFood = new HallFood();
            $hallFood->hall_id = $hall1->id;
            $hallFood->title = "Drink";
            $hallFood->price = 150;
            $hallFood->is_available = true;
            $hallFood->save();

            $hallFeature = new HallFeature();
            $hallFeature->hall_id = $hall1->id;
            $hallFeature->title = "Salad";
            $hallFeature->description = "Salad sdasd asd asda sd da ds ads ads asd as da sda sd asd asd a sd";
            $hallFeature->price = 120;
            $hallFeature->is_available = true;
            $hallFeature->save();

            $hallFeature = new HallFeature();
            $hallFeature->hall_id = $hall1->id;
            $hallFeature->title = "chiken";
            $hallFeature->description = "chiken sdasd asd asda sd da ds ads ads asd as da sda sd asd asd a sd";
            $hallFeature->price = 420;
            $hallFeature->is_available = true;
            $hallFeature->save();

            $hallFeature = new HallFeature();
            $hallFeature->hall_id = $hall1->id;
            $hallFeature->title = "Drink";
            $hallFeature->description = "Drink sdasd asd asda sd da ds ads ads asd as da sda sd asd asd a sd";
            $hallFeature->price = 150;
            $hallFeature->is_available = true;
            $hallFeature->save();

            $hallFeature = new HallTime();
            $hallFeature->hall_id = $hall1->id;
            $hallFeature->start_time = "05:00";
            $hallFeature->end_time = "10:00";
            $hallFeature->save();

            $hallFeature = new HallTime();
            $hallFeature->hall_id = $hall1->id;
            $hallFeature->start_time = "11:00";
            $hallFeature->end_time = "15:00";
            $hallFeature->save();

            $hallFeature = new HallTime();
            $hallFeature->hall_id = $hall1->id;
            $hallFeature->start_time = "16:00";
            $hallFeature->end_time = "20:00";
            $hallFeature->save();
        }
    }
}
