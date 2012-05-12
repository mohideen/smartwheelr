<?php

class vehicle {
	public $name;
	public $type;
	public $color;
}

class location {
	public $label;
	public $street;
	public $city;
	public $state;
	public $zip;
}

class preferences {
	
}

class user {
	public $userId;
	public $username;
	public $name;
	public $vehicles;
	public $locations;
	public $preferences;
	public $driverRating;
	public $passengerRating;
	
	public function getNotifications() {
		
	}
	
	public function getUpcomingRides() {
		
	}
	
	public function getPendingRideRatings() {
		
	}
}

class reservation {
	public $rideId;
	public $passengerUid;
	public $comment;
	public $status; //(Requested / Confirmed / Denied)
	public $requestedOnDate;
	public $responseDate;
}


class ride {
	public $rideId;
	public $offererId;
	public $startLocation;
	public $startLat;
	public $startLng;
	public $destinationLocation;
	public $destinationLat;
	public $destinationLng;
	public $price;
	public $maxSeats;
	public $reservedSeats;
	public $tripStartTime;
	public $tripStartDate;
	public $tripFrequency; // (onetime / recurring)
	public $recurringTripDays; //(days of the week) E.g. SMTWTFS, --T--F-, -MT-T--
	public $recurringUntil;
	public $tripType; //(oneway / rounddtrip)
	public $returnTripStartTime;
	public $reservations;
	public $status; //(Posted, Completed, Expired, Deleted)
	
	public function storeRecurringRideDates () {
		
	}
	
	public function storeRidetoDB() {

	}
}

?>