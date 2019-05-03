@extends('layouts.app')

@section('content')
<program-registration inline-template>
    <div class="grid-container">
        <template>
            <v-stepper v-model="e6" vertical>
                <v-stepper-step :complete="e6 > 1" step="1">
                    Course Details
                    <small>Here is a detail information on this course</small>
                </v-stepper-step>

                <v-stepper-content step="1">
                    <v-card color="grey lighten-4" class="mb-5">
                        <div class="grid-container">
                            <div class="grid-container">
                                <h5 class="mt-3">{{$course->title}}</h5>
                                <h5 class="mt-3"><strong>Course Description</strong></h5>
                                {{$course->description}}

                                <h5 class="mt-3"><strong>What you will learn</strong></h5>
                                <div class="grid-container">
                                    <div class="grid-container">
                                        <ul class="grid-x grid-padding-x">
                                            @foreach ($course->childrenCourses()->get() as $learn)
                                                <li class="medium-6">{{$learn->title}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <h5><strong>Course Requirement(s)</strong></h5>
                                <div class="grid-container">
                                    <div class="grid-container">
                                        <ul class="grid-x grid-padding-x">
                                            @foreach ($course->requirements as $requirement)
                                                <li class="medium-6">{{$requirement->body}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </v-card>
                    <button class="button medium" @click="e6 = 2">Continue</button>
                </v-stepper-content>

                <v-stepper-step :complete="e6 > 2" step="2">Make Payment</v-stepper-step>

                <v-stepper-content step="2">


                    <v-card color="grey lighten-4" class="mb-5">
                        <div class="grid-container">
                            Pay <strong>&#8358; {{$course->amount}}</strong> for  <strong>{{$course->title}}</strong>.
                            Your Training will base offline
                            <form method="post" action="{{$course->path()}}/subscription">
                                @csrf
                                <input type="hidden" name="class" value="true" >
                                <input type="hidden" name="pay_module" value="full" placeholder="Please Ignore this field if displayed">
                                <button type="submit" class="medium button">Make Payment Now</button>
                            </form>
                            <p>You can choose to make your payments installmental, First Installment takes 60% of the total fee and second installment takes 40%.</p>
                            <p>60% of &#8358; {{$course->amount}} is &#8358; {{$course->getFirstInstallment()}} </p>
                            <form method="post" action="{{$course->path()}}/subscription">
                                @csrf
           div>
                <input type="hidden" name="class" value="true" placeholder="Please Ignore this field if displayed">
                                <input type="hidden" name="pay_module" value="part">
                                <button type="submit" class="medium button">Pay 60% Fee Now</button>
                            </form>
                        </div>
                    </v-card>
                </v-stepper-content>
            </v-stepper>
        </template>
    </div>
</program-registration>
@endsection