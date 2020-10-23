<?php

if(!function_exists('aurl')){
    function aurl($url = null)
    {
        return url('admin/'.$url);
    }
}

if(!function_exists('admin')){
    function admin()
    {
        return Auth::guard('admin');
    }
}
if(!function_exists('paginate_collection')){
    function paginate_collection($items_paginate, $data)
    {
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $data,
            $items_paginate->total(),
            $items_paginate->perPage(),
            $items_paginate->currentPage(), [
                'path' => \Request::url(),
                'query' => [
                    'page' => $items_paginate->currentPage()
                ]
            ]
        );
    }
}

if (!function_exists('admin_link')) {
    function admin_link($uri, $recursive = true, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === Request::segment(2)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (url($uri) === Request::url()) {
                return $class_name;
            }
        }
        return ''; 
    }
}

if (!function_exists('rolesName')) {
    function rolesName() {
        if (Request::segment(1) === 'admin')  {
            return admin()->user()->name;

        }else{
            $test =[] ;
            foreach (auth()->user()->roles()->pluck('name') as $role){
                        $test[] += $role ;
                    }
            return  $test;
        }
        return ''; 
    }
}

if (!function_exists('name')) {
    function name() {
        if (Request::segment(1) === 'admin')  {
            return admin()->user()->name;

        }else{
            return  Auth::user()->name ;

        }


        return ''; 
    }
}

if (!function_exists('active_links')) {
    function active_links($uris, $recursive = true, $class_name = 'active') {
        foreach ($uris as $uri) {
            if ($recursive === true) {
                if ($uri === Request::segment(1)) {
                    return $class_name;
                }
            } else if ($recursive === false) {
                if (url($uri) === Request::url()) {
                    return $class_name;
                }
            }
        }
        return 'collapsed'; 
    }
}
if (!function_exists('active_link')) {
    function active_link($uri, $recursive = true, $class_name = 'active') {
        
        if ($recursive === true) {
            if ($uri === Request::segment(1)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (url($uri) === Request::url()) {
                return $class_name;
            }
        }
        return ''; 
    }
}



if (!function_exists('show_ul')) {
    function show_ul($uris, $recursive = true, $class_name = 'show') {
        foreach ($uris as $uri) {
            if ($recursive === true) {
                if ($uri === Request::segment(1)) {
                    return $class_name;
                }
            } else if ($recursive === false) {
                if (url($uri) === Request::url()) {
                    return $class_name;
                }
            }
        }
        return ''; 
    }
}


if (!function_exists('fliter_arrays')) {
    function fliter_arrays($columns) {
        foreach ($columns as $column) {
            foreach(request($column) as $kay1 => $value1 ){
                $isLike = 0 ;
                foreach(request($column) as $kay2 => $value2 ){
                    if($value1 == $value2){ // مقارنه بين الانبوت
                        $isLike++;  // اضافة رقم لو كان هناك تشابه
                    }
                    if($isLike > 1){ // لو الانبوت متشابهه
                        return response()->json(['status' => false, 'message' => 'صح يبني'.$column.'اكتب الـ']);
                    }
                }
            }
        }
        return false ; // لو لا يوجد تشابه
    }
}







if (!function_exists('lang')) {
    function lang() {
        if(session()->has('lang')){
            return session('lang');
        }else{
            return 'en';
        }

    }
}

if (!function_exists('dirs')) {
    function dirs() {
        if(session()->has('lang')){
            if(session('lang') == 'ar'){
                return 'rtl';
            }elseif(session('lang') == 'en'){
                return 'ltr';
            }
        }else{
            return 'ltr';
        }

    }
}

if (!function_exists('datatable_lang')) {
    function datatable_lang() {
        return ['
                "sDecimal": '.trans('DataTables.decimal').',
                "sEmptyTable": '.trans('DataTables.emptyTable').',
                "sInfo": '.trans('DataTables.info').',
                "sInfoEmpty": '.trans('DataTables.infoEmpty').',
                "sInfoFiltered": '.trans('DataTables.infoFiltered').',
                "sInfoPostFix": '.trans('DataTables.infoPostFix').',
                "sThousands": '.trans('DataTables.thousands').',
                "sLengthMenu": '.trans('DataTables.lengthMenu').',
                "sLoadingRecords": '.trans('DataTables.loadingRecords').',
                "sProcessing": '.trans('DataTables.processing').',
                "sSearch": '.trans('DataTables.search').',
                "sZeroRecords": '.trans('DataTables.zeroRecords').',
                "sPaginate": {
                    "sFirst": '.trans('DataTables.first').',
                    "sLast": '.trans('DataTables.last').',
                    "sNext": '.trans('DataTables.next').',
                    "sPrevious": '.trans('DataTables.previous').',
                },
                "sAria": {
                    "sSortAscending": '.trans('DataTables.sortAscending').',
                    "sSortDescending": '.trans('DataTables.sortDescending').',
                }
            '];
   
    }
}



if (!function_exists('convertNumberToWord')) {
    function convertNumberToWord($num = false)
    {
        
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }
        //$num = (int) $num; // ألرقم صحيح
        $num_floating = str_split($num, 2); // بيقسم كل 3 ارقام في array
        $flotCount = count($num_floating) - 1;
        $flotNum = ltrim($num_floating[$flotCount],'.');

        $num = (int) $num; // ألرقم صحيح
        $words = array();
        $list1 = array('', 'واحد', 'اثنين', 'ثلاثه', 'اربعه', 'خمسة', 'ستة', 'سبعة', 'ثمانية', 'تسعة', 'عشرة', 'احدي عشر',
            'اثناعشر', 'ثلاثة عشر', 'اربعة عشر', 'خمسة عشر', 'ستة عشر', 'سبعة عشر', 'تسع عشر', 'عشرون'
        );
        $list2 = array('', 'عشرة', 'عشرون', 'ثلاثون', 'اربعون', 'خمسون', 'ستون', 'سبعون', 'ثمانون', 'تسعون', 'مائه');
        $list3 = array('', 'الاف', 'مليون', 'بليون', 'بليار'
        );
        $list4 = array('', 'عشرة قروش', 'عشرون قرشاً', 'ثلاثون قرشاً', 'اربعون قرشاً', 'خمسون قرشاً', 'ستون قرشاً', 'سبعون قرشاً', 'ثمانون قرشاً', 'تسعون قرشاً'
        );


        $num_length = strlen($num); // عدد الارقام
        
        $levels = (int) (($num_length + 2) / 3); // المستوي
        $max_length = $levels * 3; 
        $num = substr('00' . $num, -$max_length); 
        $num_levels = str_split($num, 3); // بيقسم كل 3 ارقام في array
        
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--; // بينقص واحد من المستوي

            $hundreds = (int) ($num_levels[$i] / 100); // بيقسم كل واحده من الarray علي 100

            if($hundreds == 1){
                $hundreds = ($hundreds ? ' ' . ' مائه' . ' و' : '');
                
            }elseif($hundreds == 2){
                $hundreds = ($hundreds ? ' '  . ' مئتان' . ' و' : '');
                
            }else{
                $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' مائه' . ' و' : '');
                
            }
            $tens = (int) ($num_levels[$i] % 100); // بتجيب الرقمين اللي ف الاول


            $singles = '';
            if ( $tens < 20 ) { // لو هيا اقل من 20 بيجيب من ال list 1
                if($tens == 1){
                    $tens = '';
                }
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );

                if( $levels && ( int ) ( $num_levels[$i] ) == 1){
                    $tens = '' ;
                }
                if($levels == 1  ){
                    if ( ( int ) ( $num_levels[$i]) == 2) {
                        $tens = '' ;
                    }elseif(( int ) ( $num_levels[$i] ) == 1){
                        $tens = '' ;
                    }
                }

            } else { // لو هيا اكثر من  20 بجيب من الlist 2
                $tens =($tens / 10); // بيقسم علشان يجيب الرقم العشرات

                $tens = ' ' . $list2[$tens] . ' '; //

                $singles = (int) ($num_levels[$i] % 10);

                $singles = ($singles ? ' ' . $list1[$singles] .  ' و' : '');

            }

            if( $levels && ( int ) ( $num_levels[$i] ) == 1){
                if($levels == 1){
                    $mlion = ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . 'الف'  . ' و' : '' ;
                }else{
                    $mlion = ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels]  . ' و' : '' ;
                }
            }

            else{
                $mlion = '';
                if($levels == 1  ){
                    if ( ( int ) ( $num_levels[$i]) == 2) {
                        $mlion = ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . 'الفان' . ' و' : '';
                    }elseif(( int ) ( $num_levels[$i] ) == 1 || ( int ) ( $num_levels[$i] ) > 10 ){
                        $mlion = ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . 'الف' . ' و' : '';
                    }else{
                        $mlion = ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' و' : '';
                    }

                }else{

                    $mlion = ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' و' : '';
                }

            }
            $words[] = $hundreds . $singles . $tens . $mlion;

        } //end for loop
        $commas = count($words);

        if ($commas > 1) {
            for ($i = 0; $i < count($words); $i++) {

                if($words[$i] == ""){

                    $commas = $i - 1;

                    $str = rtrim($words[$commas],'و');

                    $words[$commas] =  $str ;
                    
                }
           }
        }

        
        $NoR = implode(' ', $words);
        $FinshWords = rtrim($NoR,'و');
        if($list4[$flotNum] == ""){
            return $FinshWords . 'جنيهاً';

        }else{
            return $FinshWords . 'جنيها و' .$list4[$flotNum];

        }


    }
}



