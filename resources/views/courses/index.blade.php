@extends('layouts.app')

@section('content')

  <div class="container">
    <courses-catalogue :subjectscatalogue="{{$subjects}}" inline-template>
      <div>
        <div class="section">
          <course-search class="form__field" :forum="false"></course-search>
        </div>

        <div class="section">
          <div class="columns is-mobile">
            <div class="column is-6">
              <div class="select is-fullwidth">
                <select @change="sortItems" class="is-fullwidth is-loading" v-model="sortItem">
                  <option value="">Sort</option>
                  <option :value="sort.destination" v-for="sort in sortList" v-text="sort.value"></option>
                </select>
              </div>
            </div>
            <div class="column is-6">
              <div class="select is-fullwidth">
                <select @change="sortItems" v-model="sortedSubject">
                  <option value="">All Subjects</option>
                    <option v-for="subject in subjects" :value="subject.slug" v-text="subject.name"></option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <p v-show="working" class="has-text-centered is-size-4">Wait a second, and let me do my job</p>
        <div>
          <div class="columns is-multiline" >
              @include('courses.partials.course')
          </div>
          {{-- <div>
            <img src="{{ asset('images/loading-blue.gif') }}">
          </div> --}}
        </div>

      </div>
    </courses-catalogue>
  </div>
@endsection