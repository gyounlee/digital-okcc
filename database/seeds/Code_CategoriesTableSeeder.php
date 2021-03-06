<?php

use Illuminate\Database\Seeder;

class Code_CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Member Status: 회원, 비정기출석, 장기결석, 해외거주, 이명, 사망, 전도대상자
        DB::table('code_categories')->insert([ 
            'txt' => 'Church Members',
            'kor_txt' => '교인구분',
            'memo' => 'A code category for identifying the status of OKCC members.',
            'fieldName' => 'status_id',
            'order' => 1
        ]);
        // Duty: 교회직분 - 담임목사, 부목사, 목사, 전도사, 교육목사, 교육전도사, 시무장로, 은퇴장로, 권사, 은퇴권사, 집사, 협동장로, 협동권사, 위원
        DB::table('code_categories')->insert([ 
            'txt' => 'Officers',
            'kor_txt' => '직무',
            'memo' => 'A code category for identifying the duty of OKCC members.',
            'fieldName' => 'duty_id',
            'order' => 2
        ]);
        // Family Relations: 본인, 처, 자녀, 부모, 손주 
        DB::table('code_categories')->insert([ 
            'txt' => 'Relation of Householder',
            'kor_txt' => '세대주관계',
            'memo' => 'A code category for identifying the relationship with the head of household.',
            'fieldName' => 'family_id',
            'order' => 3
        ]);
        // Baptism Status: 세례, 유아세례, 입교, 영세
        DB::table('code_categories')->insert([ 
            'txt' => 'Baptism',
            'kor_txt' => '신급',
            'memo' => 'A code category for identifying the baptism status of OKCC members.',
            'fieldName' => 'baptism_id',
            'order' => 4
        ]);
        // Department: 당회, 권사회, 집사회, 교육부, 성가대, 단기선교회, 남선교회, 제1여선교회, 제2여선교회 등
        DB::table('code_categories')->insert([ 
            'txt' => 'Department',
            'kor_txt' => '부서',
            'memo' => 'A code category for identifying the department of OKCC.',
            'fieldName' => 'department_id',
            'order' => 5
        ]);
        // City code
        DB::table('code_categories')->insert([ 
            'txt' => 'City',
            'kor_txt' => '시',
            'memo' => 'A code category for identifying Cities of Canada.',
            'fieldName' => 'city_id',
            'order' => 6
        ]);
        // Province code
        DB::table('code_categories')->insert([ 
            'txt' => 'Province',
            'kor_txt' => '주',
            'memo' => 'A code category for identifying Provinces of Canada.',
            'fieldName' => 'province_id',
            'order' => 7
        ]);
        // Country code
        DB::table('code_categories')->insert([ 
            'txt' => 'Country',
            'kor_txt' => '국가',
            'memo' => 'A code category for identifying Country.',
            'fieldName' => 'country_id',
            'order' => 8
        ]);
        // 교구
        DB::table('code_categories')->insert([ 
            'txt' => 'Gyogoo',
            'kor_txt' => '교구',
            'memo' => 'A code category for identifying Kyogu.',
            'fieldName' => 'department_id',
            'order' => 9
        ]);
        // LOG
        DB::table('code_categories')->insert([ 
            'txt' => 'Log',
            'kor_txt' => '로그',
            'memo' => 'A code category for using at system log view.',
            'fieldName' => 'log_id',
            'order' => 10
        ]);
        // Position
        DB::table('code_categories')->insert([ 
            'txt' => 'Position',
            'kor_txt' => '직책',
            'memo' => 'A code category for using Position.',
            'fieldName' => 'position_id',
            'order' => 11
        ]);
    }
}
