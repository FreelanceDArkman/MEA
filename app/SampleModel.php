<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class SampleModel extends Model
{

    public function getRow()
    {




        $sql = "SELECT * FROM TBL_USER WHERE EMP_ID = 1234567";
        return DB::select(DB::raw($sql))[0];

        // Same below
        //return DB::table('TBL_USER')->Where('EMP_ID', '=' , 1234567)->first();

        /*

        {#244 ▼
          +"EMP_ID": "1234567"
          +"USERNAME": "1234567"
          +"PASSWORD": "UUHmtvyG+Y7+55KHMLnXDA=="
          +"PASSWORD_EXPIRE_DATE": null
          +"CREATE_DATE": "2015-11-30 17:30:49.000"
          +"CREATE_BY": "admin"
          +"LAST_MODIFY_DATE": "2016-01-26 16:17:42.000"
          +"CHANGE_PWD_DATE": null
          +"ACTION_BY": null
          +"USER_PRIVILEGE_ID": "0"
          +"ACCESS_PERMISSIONS": "1:1|1:2|2:1|2:2|2:3|2:4|3:1|3:2|3:3|4:1|4:2|5:1|5:2|5:3|6:1|7:1|7:2|8:1|8:2|20:1|20:2|20:3|21:1|21:2|21:3|22:1|22:2|23:1|23:2|24:1|50:1|50:2|51:1|51:2|51:3|51:4|51:5|51:6|51:7|52:1|53:1|53:2|54:1|54:2|55:1|55:2|56:1|57:1|58:1|58:2|58:3|58:4|58:5|58:6|58:7|58:8|58:9|58:10|58:11|58:12|58:13|59:1|59:2|59:3|59:4"
          +"ADDRESS": "Bangkok 10900"
          +"PHONE": "0891234567"
          +"EMAIL": "Natthawut@sun-system.com"
          +"USER_STATUS_ID": "11"
          +"LEAVE_FUND_GROUP_DATE": "1900-01-01 00:00:00.000"
          +"RETURN_FUND_GROUP_DATE": "1900-01-01 00:00:00.000"
          +"FIRST_LOGIN_FLAG": "1"
          +"LEAVE_FUND_FLAG": ""
          +"DEVICE_ID": "712fewfwg1554fdwq"
          +"DEVICE_OS": "iOS"
          +"EMAIL_NOTIFY_FLAG": "1"
        }

         */
    }


    public function getRows()
    {
        //return DB::table('TBL_USER')->skip(10)->take(5)->where('USER_PRIVILEGE_ID',0)->get();

        $sql = "SELECT TOP 5 * FROM TBL_USER";
        return DB::select(DB::raw($sql));

        /*
         array:5 [▼
          0 => {#244 ▼
            +"EMP_ID": "0000001"
            +"USERNAME": "test"
            +"PASSWORD": "Eg4iGHekjWs="
            +"PASSWORD_EXPIRE_DATE": "2999-12-01 00:00:00.000"
            +"CREATE_DATE": "2015-07-01 22:28:28.000"
            +"CREATE_BY": "admin"
            +"LAST_MODIFY_DATE": "2015-08-01 22:28:35.000"
            +"CHANGE_PWD_DATE": "2015-10-01 01:17:25.000"
            +"ACTION_BY": "user"
            +"USER_PRIVILEGE_ID": "2"
            +"ACCESS_PERMISSIONS": "1:1|1:2|2:1|2:2|2:3|2:4|3:1|3:2|3:3|4:1|4:2|5:1|5:2|5:3|6:1|7:1|7:2|8:1|8:2|20:1|20:2|20:3|21:1|21:2|21:3|22:1|22:2|23:1|23:2|24:1"
            +"ADDRESS": "bangkok 10902 กรุงเทพฯ"
            +"PHONE": "0891234567"
            +"EMAIL": "Vegagravity@gmail.com"
            +"USER_STATUS_ID": "11"
            +"LEAVE_FUND_GROUP_DATE": null
            +"RETURN_FUND_GROUP_DATE": null
            +"FIRST_LOGIN_FLAG": "1"
            +"LEAVE_FUND_FLAG": null
            +"DEVICE_ID": "0476a5044f1389987cb18953888ba6a3bf1a91578b712ef680c649c0e190cef2"
            +"DEVICE_OS": "iOS"
            +"EMAIL_NOTIFY_FLAG": "1"
          }
          1 => {#246 ▶}
          2 => {#247 ▶}
          3 => {#248 ▶}
          4 => {#249 ▶}
        ]
         */
    }

    public function insertData()
    {
        $sql = "INSERT INTO table_name (`column1`, `column2`, `column3`) VALUES (`value1`, `value2`, `value3`)";
        return DB::insert(DB::raw($sql));
    }

    public function deleteData()
    {
        $sql = "DELETE FROM table_name WHERE some_column = some_value";
        return DB::delete(DB::raw($sql));
    }

    public function updateData()
    {
        $sql = "UPDATE table_name SET column1=value1, column2=value2 WHERE some_column=some_value ";
        return DB::update(DB::raw($sql));
    }
}
