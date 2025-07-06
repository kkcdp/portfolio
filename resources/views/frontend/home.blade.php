@extends('frontend.layouts.layout')

@section('content')

<!-- Header-Area-Start -->

		<!-- Header-Area-End -->
        @include('frontend.sections.hero')


		<!-- Service-Area-Start -->
		@include('frontend.sections.service')

		<!-- About-Area-Start -->
		@include('frontend.sections.about')

		<!-- Portfolio-Area-Start -->
		@include('frontend.sections.portfolio')
		<!-- Skills-Area-Start -->
		@include('frontend.sections.skill')

		<!-- Experience-Area-Start -->
		@include('frontend.sections.experience')

		<!-- Testimonial-Area-Start -->
        @include('frontend.sections.testimonial')

		<!-- Blog-Area-Start -->
		@include('frontend.sections.blog')

		<!-- Contact-Area-Start -->
		@include('frontend.sections.contact')

@endsection
