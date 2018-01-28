<?php

Route::get('import', 'ImportController@showImport');

Route::post('import', 'ImportController@import');

Route::get('add-candidates', 'AddController@showAdd');

Route::post('add-candidates', 'AddController@add');

Route::get('fetch-course', 'FetchController@fetchCourseView');

Route::post('fetch-course', 'FetchController@fetchCourse');

Route::get('fetch-student', 'FetchController@fetchStudentView');

Route::post('fetch-student', 'FetchController@fetchStudent');

Route::get('fetch-candidates', 'FetchController@fetchCandidateView');

Route::post('fetch-candidates', 'FetchController@fetchCandidate');

Route::get('vue-test', 'FetchController@vueTest');

Route::get('student-login', 'StudentController@loginView');

Route::post('student-login', 'StudentController@login');

Route::get('vote', 'StudentController@voteView');

Route::get('api/candidates', 'StudentController@getCandidates');

