<?php

namespace App\Http\Controllers;


use DB;
use File;
use Image;

use Illuminate\Http\Request;
use App\User;
use App\Model\Userlevel;
use App\Model\System;
use App\Model\Page;
use App\Model\Social;
use App\Model\Newsletter;
use App\Model\Contact;
use App\Model\News;
use App\Model\NewsCategory;
use App\Model\Slider;

class FrontController extends Controller
{   // chứa thành phần dùng chung
    public function __construct(){
        @session_start();

        //logo
        $logo = System::select('Description')->where('Code', 'logo')->first();
        view()->share('logo', $logo);

         //favicon
        $favicon = System::select('Description')->where('Code', 'favicon')->first();
        view()->share('favicon', $favicon);

        //Copyright
        $copyright = System::select('Description')->where('Code', 'copyright')->first();
        view()->share('copyright', $copyright);

        //social
        $Social = Social::where('Status', 1)->selectRaw('Name, Font, Alias')->orderBy('Sort','ASC')->get();
        view()->share('Social', $Social);

        //page
        $Page = Page::where('Status', 1)->selectRaw('Name, Font, Alias')->orderBy('Sort','ASC')->get();
        view()->share('Page', $Page);
    }
    //đưa tin ra trnag wed
    public function home(){

        $PageInfo = Page::where('Status',1)->where('Alias','/')
        ->selectRaw('Name, Images, Alias, MetaTitle, MetaDescription, MetaKeyword')->first();

        $News =  DB::table('news as a')
        ->join('news_cat as b','a.RowIDCat','=','b.RowID')
        ->selectRaw('a.*,b.Name as  CategoryName')
        ->where('a.RowIDCat',1)
        ->orderBy('a.RowID','DESC')
        ->limit(6)->get();

        $NewsSale =  DB::table('news as a')
        ->join('news_cat as b','a.RowIDCat','=','b.RowID')
        ->selectRaw('a.*,b.Name as  CategoryName')
        ->where('a.RowIDCat',2)
        ->orderBy('a.RowID','DESC')
        ->limit(4)->get();

        $NewsViews =  DB::table('news as a')
        ->join('news_cat as b','a.RowIDCat','=','b.RowID')
        ->selectRaw('a.*,b.Name as  CategoryName')
        ->orderBy('a.Views','DESC')
        ->limit(4)->get();

        $Slider = Slider::where('Status',1 )->selectRaw('Name, Alias, Images')->orderBy('Sort','ASC')->get();


        return view ('front.home.home', compact('PageInfo','News','NewsSale','NewsViews','Slider',));
    }






    public function contact(){
        $PageInfo = Page::where('Status',1)->where('Alias','lien-he')
        ->selectRaw('Name, Images, Alias, MetaTitle, MetaDescription, MetaKeyword, Description')->first();

        $Map = System::where('Status', 1)
        ->where('Code', 'map')
        ->select('Description')->first();

        return view ('front.contact.contact', compact('PageInfo', 'Map'));
    }

    public function slug($slug, request $request){
        $newsCat = Page::where('Status',1)->where('Alias', $slug)->first();

        if (isset($newsCat) && $newsCat != NULL){
            $listNews = DB::table('news as a')
            ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
            ->where('a.Status', 1)
            ->where('b.Alias',$slug)
            ->selectRaw('a.Alias, a.Name, a.Images, a.SmallDescription')
            ->paginate(12); 

            return view ('front.news.cat', compact('newsCat','listNews'));
        }

    }
     public function slugHtml($slug, request $request){
        $newsDetail = DB::table('news as a')
            ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
            ->where('a.Status', 1)
            ->where('a.Alias',$slug)
            ->selectRaw('a.Alias, a.Name, a.Images, a.MetaDescription, a.MetaTitle, a.MetaKeyword, a.Description, a.created_at, a.Views, a.Name as NewsCatName, b.Alias as NewsCatAlias')
            ->orderBy('a.Views','DESC')
            ->first();

            return view('front.news.detail',compact('newsDetail'));

     }


    // subrice  email
    public function subEmail(Request $request){
        
        if ($Request->txtEmailSub != ''){
            $Newsletter = Newsletter::where('Email', $request->txtEmailSub)->get();
            if(isset($Newsletter)&& count($Newsletter) > 0) {
                echo 'error_exit_email';
             }else{
                $Newsletter = new Newsletter;
                $Newsletter ->Email = $request->txtEmailSub;

                $Flag = $Newsletter->save();

                if ($Flag == true) {
                    echo'finish';
                } else {
                    echo'error';
                 }
            }
        }else{
            echo'error';
        }      
    }

}


