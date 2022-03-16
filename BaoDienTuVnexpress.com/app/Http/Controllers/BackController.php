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


class BackController extends Controller
{
    public function __construct(){
        @session_start();
    }




    public function home(){
        return view ('back.home.home');
    }


    //staff management..................
    public function staff_profile(){
        return view ('back.staff.profile');
    }

    public function staff_profile_post(Request $request){
        if ($request->fullmane == ''|| $request->email == ''|| $request->phone == ''){
            return redirect('admin/staff/profile ')->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            }
            $User =  User::find($request->id);
            $User->fullmane = $request->fullmane;
            $User->address = $request->address;
            $User->email = $request->email;
            $User->phone = $request->phone;

            if(isset($request->password) && $request->password !== ''){
                $User->password = bcrypt($request->password);
            }
            $Flag = $User->save();

            if ($Flag == true) {
             return redirect('admin/staff/profile')->with(['flash_level' =>'success', 'flash_message'=> 'Cập nhật tài khoản thành công']);
            } else {
               return redirect('admin/staff/profile')->with(['flash_level' =>'danger','flash_message'=>'Chỉnh sửa tài khoản không thành công']);
             }
        }

    public function staff_list(){

        $User = DB::table('users as a')
        ->join('users_level as b','a.level','=','b.id')
        ->selectRaw('a.id, a.fullmane , a.address , a.email ,a.phone , b.name')->get();

        return view('back.staff.list',compact('User'));
    }

    public function staff_add(){
        $Userlevel = Userlevel::where('status',1)->get();

        return view('back.staff.add',compact('Userlevel'));
    }

    public function staff_add_post(Request $request){
        if ($request->fullmane == ''|| $request->email == ''|| $request->phone == '' ||$request->username == '' ||$request->password =='' ){
            return redirect('admin/staff/add ')->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            }

            $User = new User;
            $User->level= $request->level;
            $User->status = 1;
            $User->username = $request->username;
            $User->password = bcrypt($request->password);
            $User->fullmane = $request->fullmane;
            $User->address = $request->address;
            $User->email = $request->email;
            $User->phone = $request->phone;
            $Flag = $User->save();

             if ($Flag == true) {
                 return redirect('admin/staff/list')->with(['flash_level' =>'success', 'flash_message'=> 'Thêm nhân viên thành công']);
                } else {
                   return redirect('admin/staff/list')->with(['flash_level' =>'danger','flash_message'=>'Lỗi thêm nhân viên']);
                }
    }
       

    public function staff_edit(Request $request , $id){

        $User = User::find($id);

        $Userlevel = Userlevel::where('status',1)->get();
        return view('back.staff.edit',compact('User','Userlevel'));
    } 
    public function staff_edit_post(Request $request , $id){
         if ($request->fullmane == ''|| $request->email == ''|| $request->phone == ''  ){
            return redirect('admin/staff/add ')->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            }
             $User =  User::find($id);
            $User->level = $request->level;
            $User->status = $request->status;

            if(isset($request->password) && $request->password !== ''){
                $User->password = bcrypt($request->password);
            }

            $User->fullmane = $request->fullmane;
            $User->address = $request->address;
            $User->email = $request->email;
            $User->phone = $request->phone;
            $Flag = $User->save();

             if ($Flag == true) {
                 return redirect('admin/staff/edit/' .$id)->with(['flash_level' =>'success', 'flash_message'=> 'Chỉnh sữa viên thành công']);
                } else {
                   return redirect('admin/staff/edit/' .$id)->with(['flash_level' =>'danger','flash_message'=>'Lỗi sữa nhân viên']);
                }
    }

    public function staff_delete(Request $request , $id){

             $User =  User::find($id);

             $Flag = $User->delete();

             if ($Flag == true) {
                 return redirect('admin/staff/list')->with(['flash_level' =>'success', 'flash_message'=> 'Xóa viên thành công']);
                } else {
                   return redirect('admin/staff/list')->with(['flash_level' =>'danger','flash_message'=>'Lỗi xóa nhân viên']);
                }
    }

    //staff management..................




    //systme management..................

    public function system(){
         $name = System::where('Status',1)->where('Code','name')->first();
         $email = System::where('Status',1)->where('Code','email')->first();
         $phone = System::where('Status',1)->where('Code','phone')->first();      
         $address = System::where('Status',1)->where('Code','address')->first();
         $copyright = System::where('Status',1)->where('Code','copyright')->first();
         $logo = System::where('Status',1)->where('Code','logo')->first();
         $favicon = System::where('Status',1)->where('Code','favicon')->first();
         $map = System::where('Status',1)->where('Code','map')->first();


        return view('back.system.system',compact( 
            'name','logo','email','phone','address','copyright','logo','favicon','map'
        ));
       

    }

    public function system_post(Request $request ){

         if ($request->name == ''|| $request->email == ''|| $request->phone == '' ){
            return redirect('admin/system ')->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            }

            //update tên công ty
           System::where('Status',1)
           ->where('Code','name')
           ->update(['Description' => $request->name]);

            System::where('Status',1)
           ->where('Code','email')
           ->update(['Description' => $request->email]);

            System::where('Status',1)
           ->where('Code','phone')
           ->update(['Description' => $request->phone]);

            System::where('Status',1)
           ->where('Code','address')
           ->update(['Description' => $request->address]);

            System::where('Status',1)
           ->where('Code','copyright')
           ->update(['Description' => $request->copyright]);

            System::where('Status',1)
           ->where('Code','map')
           ->update(['Description' => $request->map]);


            //logo
           if(!empty($request->file('logo'))){
            $logo = System::where('Status',1)->where('Code','logo')->first();
            $path = 'images/logo/'.$logo->Description;
            if(File::exists($path)){
                File::delete($path);
            }

            //upload image
            $name = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move('images/logo/' , $name);

            $logo->Description= $name;
            $logo->save();
           }

            //favicon
           if(!empty($request->file('favicon'))){
            $favicon = System::where('Status',1)->where('Code','favicon')->first();
            $path = 'images/favicon/'.$favicon->Description;
            if(File::exists($path)){
                File::delete($path);
            }

            //upload image
            $name = $request->file('favicon')->getClientOriginalName();
            $request->file('favicon')->move('images/favicon/' , $name);

            $favicon->Description= $name;
            $favicon->save();
           }
          
           return redirect('admin/system ')->with(['flash_level' => 'success', 'flash_message' => '  Chỉnh sửa thành công']); 

    }

    //systme management..................

    //page management..................

        public function page_list(){
             $Page = Page::get();

             return view('back.page.list',compact('Page'));

        }
        public function page_edit(Request $request , $id){
            $Page = Page::find($id);

            return view('back.page.edit',compact('Page'));
        }

        public function page_edit_post(Request $request , $id){
            if ($request->Name == ''){
            return redirect('admin/page/edit/'.$id)->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 

            $Page =  Page::find($id);
            $Page->Name = $request->Name;
            $Page->Alias = $request->Alias; 
            $Page->Status = $request->Status;
            $Page->Font = $request->Font;
            $Page->Sort = $request->Sort; 
            $Page->MetaTitle = $request->MetaTitle;
            $Page->MetaDescription = $request->MetaDescription;
            $Page->MetaKeyword = $request->MetaKeyword;
            $Page->Description = $request->Description;           
            


            
            if($request->hasFile('Images')){
                $file = $request->file('Images');
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit .'-'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());

                 if($duoi != 'png' && $duoi !='jpg' && $duoi !='jpeg' && $duoi !='svg' ){
                    return back()->with(['flash_level' => 'danger', 'flash_message '=> 'Mở rộng file hình ảnh']);
                }
                if($Page->Images !=''){
                    if(file_exists('images/page/'.$Page->Images)){
                        unlink('images/page/'.$Page->Images);
                    }
                }
                // up hình ảnh lên sever
                $file->move('images/page',$name);
                $img = Image::make('images/page/'.$name);
                // kiểm tra nếu không tồn tại thì tạo folder
                $filePath = "images/page/".date('Y');
                if (!file_exists($filePath)){
                    mkdir("images/page/".date('Y'), 0777, true);
                }
                $img->fit(400,300);
                $img->save('images/page/'.date('Y').'/'.$name);
                //xóa  hình tải lên
                if(file_exists('images/page/'.$name)){
                    unlink('images/page/'.$name);
                }

                $Page->Images = date('Y').'/'.$name;

            } 
            $Flag = $Page->save();
            if ($Flag == true) {
                 return redirect('admin/page/edit/' .$id)->with(['flash_level' =>'success', 'flash_message'=> 'Chỉnh sữa thành công']);
                } else {
                   return redirect('admin/staff/edit/' .$id)->with(['flash_level' =>'danger','flash_message'=>'Lỗi chỉnh sữa ']);
                }
            }
    //page management..................

    //newsletter management..................

        public function newsletter_list(){
             $Newsletter = Newsletter::get();
             return view('back.newsletter.list',compact('Newsletter'));

        }
        public function newsletter_edit(Request $request , $id){
            $Newsletter = Newsletter::find($id);
            return view('back.newsletter.edit', compact('Newsletter'));
        }

        public function newsletter_edit_post(Request $request , $id){
            if ($request->Email == '' ){
            return redirect('admin/newsletter/edit/'.$id)->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 

            $Newsletter =  Newsletter::find($id);
            $Newsletter->Email = $request->Email;
            $Newsletter->IsViews = $request->IsViews;
                    
            $Flag = $Newsletter->save();

             if ($Flag == true) {
                 return redirect('admin/newsletter/edit/' .$id)->with(['flash_level' =>'success', 'flash_message'=> 'Chỉnh sữa thành công']);
                } else {
                   return redirect('admin/newsletter/edit/' .$id)->with(['flash_level' =>'danger','flash_message'=>'Lỗi chỉnh sữa ']);
                }
            }

        public function newsletter_delete(Request $request , $id){
            $Newsletter =  Newsletter::find($id);
            $Flag = $Newsletter->delete();

            if($Flag == true){
                return redirect('admin/newsletter/list/')->with(['flash_level' =>'success', 'flash_message'=> 'Xóa thành công']);
            } else {
                   return redirect('admin/newsletter/list/')->with(['flash_level' =>'danger','flash_message'=>'Lỗi xóa email ']);
            }
        }
    //newsletter management..................

    //social management..................

        public function social_list(){
            $Social = Social::get();

            return view('back.social.list',compact('Social'));
        }
        public function social_edit(Request $request , $id){
             $Social = Social::find($id);

            return view('back.social.edit',compact('Social'));
        }
        public function social_edit_post(Request $request , $id){
            if ($request->Name == ''|| $request->Font == '' ){
            return redirect('admin/social/edit/'.$id)->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 

            $Social =  Social::find($id);
            $Social->Name = $request->Name;
            $Social->Alias = $request->Alias;
            $Social->Status = $request->Status;
            $Social->Font = $request->Font;
            $Social->Sort = $request->Sort;         
            $Flag = $Social->save();

             if ($Flag == true) {
                 return redirect('admin/social/edit/' .$id)->with(['flash_level' =>'success', 'flash_message'=> 'Chỉnh sữa email khuyến mãithành công']);
                } else {
                   return redirect('admin/social/edit/' .$id)->with(['flash_level' =>'danger','flash_message'=>'Lỗi chỉnh sữa ']);
                }
        }

    //social management..................

    //contact management..................

        public function contact_list(){
             $Contact = Contact::get();
             return view('back.contact.list',compact('Contact'));

        }
        public function contact_edit(Request $request , $id){
            $Contact = Contact::find($id);
            return view('back.contact.edit', compact('Contact'));
        }

        public function contact_edit_post(Request $request , $id){
            if ($request->Email == '' || $request->Name =='' || $request->Message == ''  || $request->Phone == ''){
            return redirect('admin/contact/edit/'.$id)->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 

            $Contact =  Contact::find($id);
            $Contact->Name = $request->Name;
            $Contact->Email = $request->Email;
            $Contact->Phone = $request->Phone;
            $Contact->IsViews = $request->IsViews;

                    
            $Flag = $Contact->save();

             if ($Flag == true) {
                 return redirect('admin/contact/edit/' .$id)->with(['flash_level' =>'success', 'flash_message'=> 'Chỉnh sữa thành công']);
                } else {
                   return redirect('admin/contact/edit/' .$id)->with(['flash_level' =>'danger','flash_message'=>'Lỗi chỉnh sữa ']);
                }
            }
            
        public function contact_delete(Request $request , $id){
            $Contact =  Contact::find($id);
            $Flag = $Contact->delete();

            if($Flag == true){
                return redirect('admin/contact/list/')->with(['flash_level' =>'success', 'flash_message'=> 'Xóa thành công']);
            } else {
                   return redirect('admin/contact/list/')->with(['flash_level' =>'danger','flash_message'=>'Lỗi xóa liên hệ ']);
            }
        }
    //contact management..................


    //news category management............
        public function news_cat_list(){
           $NewsCategory =  NewsCategory::where('Status',1)->get();

           return view('back.news.cat_list', compact('NewsCategory'));
        }

        public function news_cat_getedit($RowID){
            $NewsCategory =  NewsCategory::find($RowID);

           return view('back.news.cat_edit', compact('NewsCategory'));
        }

        public function news_cat_edit(Request $request, $RowID){
            if ( $request->Name =='' ){
            return redirect('admin/news_cat/edit/'.$RowID)->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 
            $NewsCategory =  NewsCategory::find($RowID);
            $NewsCategory->Status =  $request->Status;
            $NewsCategory->Name =  $request->Name;
            $NewsCategory->Alias =  $request->Alias;
             $Flag = $NewsCategory->save();

             if ($Flag == true) {
                 return redirect('admin/news_cat/edit/' .$RowID)->with(['flash_level' =>'success', 'flash_message'=> 'Chỉnh sữa thành công']);
                } else {
                   return redirect('admin/news_cat/edit/' .$RowID)->with(['flash_level' =>'danger','flash_message'=>'Lỗi chỉnh sữa ']);
                }
        }
    //news category management............


    //news  management....................

        public function news_list(){
            $News =  DB::table('news as a')
            ->join('news_cat as b','a.RowIDCat','=','b.RowID')
            ->selectRaw('a.*,b.Name as  CategoryName')
            ->orderBy('a.RowID','DESC')
            ->get();

           return view('back.news.list', compact('News'));
        }
        public function news_getAdd(){
            $NewsCategory =  NewsCategory::get();

            return view('back.news.add', compact('NewsCategory'));
        }

        public function news_add(Request $request){
            if ($request->Name == ''|| $request->Description == '' ){
            return redirect('admin/news/add/')->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 
            $News = new News;
            $News->RowIDCat= $request->RowIDCat;
            $News->Status = $request->Status;;
            $News->Name = $request->Name;
            $News->Alias = $request->Alias;
            $News->Views = $request->Views;         
            $News->MetaTitle = $request->MetaTitle;
            $News->MetaDescription = $request->MetaDescription;
            $News->MetaKeyword = $request->MetaKeyword;
            $News->SmallDescription = $request->SmallDescription;
            $News->Description = $request->Description;

            if($request->hasFile('Images')){
                $file = $request->file('Images');
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit.'-'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());

                if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg' ){
                    return back()->with(['flash_level' => 'danger', 'flash_message '=> 'Mở rộng file không được hỗ trợ']);
                }
                $file->move('images/news',$name);
                
                $img = Image::make('images/news/'.$name);
                // kiểm tra nếu không tồn tại thì tạo folder
                $filePath = "images/news/".date('Y');
                if (!file_exists($filePath)){
                    mkdir("images/news/".date('Y'), 0777, true);
                }
                $img->fit(208,141);
                $img->save('images/news/'.date('Y').'/'.$name);
                //xóa  hình tải lên
                if(file_exists('images/news/'.$name)){
                    unlink('images/news/'.$name);
                }

                $News->Images = date('Y').'/'.$name;

            } 

            $Flag = $News->save();

             if ($Flag == true) {
                 return redirect('admin/news/list')->with(['flash_level' =>'success', 'flash_message'=> 'Thêm  thành công']);
                } else {
                   return redirect('admin/news/list')->with(['flash_level' =>'danger','flash_message'=>'Lỗi thêm khi thêm tin tức']);
                }
        }

        public function news_getedit(Request $request, $RowID){
            $NewsCategory =  NewsCategory::get();
            $News = News::find($RowID);
            return view('back.news.edit', compact('News','NewsCategory'));
        }

        public function news_edit(Request $request, $RowID){
            if ($request->Name == ''|| $request->Description == '' ){
            return redirect('admin/news/edit/'.$RowID)->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 
            $News = News::find($RowID);
            $News->RowIDCat= $request->RowIDCat;
            $News->Status = $request->Status;;
            $News->Name = $request->Name;
            $News->Alias = $request->Alias;
            $News->Views = $request->Views;         
            $News->MetaTitle = $request->MetaTitle;
            $News->MetaDescription = $request->MetaDescription;
            $News->MetaKeyword = $request->MetaKeyword;
            $News->SmallDescription = $request->SmallDescription;
            $News->Description = $request->Description;

            if($request->hasFile('Images')){
                $file = $request->file('Images');
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit .'-'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());

                 if($duoi != 'png' && $duoi !='jpg' && $duoi !='jpeg' && $duoi !='svg' ){
                    return back()->with(['flash_level' => 'danger', 'flash_message '=> 'Mở rộng file hình ảnh']);
                }
                if($News->Images !=''){
                    if(file_exists('images/news/'.$News->Images)){
                        unlink('images/news/'.$News->Images);
                    }
                }
                // up hình ảnh lên sever
                $file->move('images/news',$name);
                $img = Image::make('images/news/'.$name);
                // kiểm tra nếu không tồn tại thì tạo folder
                $filePath = "images/news/".date('Y');
                if (!file_exists($filePath)){
                    mkdir("images/news/".date('Y'), 0777, true);
                }
                $img->fit(208,141);
                $img->save('images/news/'.date('Y').'/'.$name);
                //xóa  hình tải lên
                if(file_exists('images/news/'.$name)){
                    unlink('images/news/'.$name);
                }

                $News->Images = date('Y').'/'.$name;

            } 



            $Flag = $News->save();

             if ($Flag == true) {
                 return redirect('admin/news/edit/'.$RowID)->with(['flash_level' =>'success', 'flash_message'=> 'Chỉnh sữa  thành công']);
                } else {
                   return redirect('admin/news/list/'.$RowID)->with(['flash_level' =>'danger','flash_message'=>'Lỗi Chỉnh sữa  tin tức']);
                }
        }

        public function news_delete(Request $request , $RowID){
            $News =  News::find($RowID);
             if($News->Images !=''){
                    if(file_exists('images/news/'.$News->Images)){
                        unlink('images/news/'.$News->Images);
                    }
                }
            $Flag = $News->delete();

            if($Flag == true){
                return redirect('admin/news/list/')->with(['flash_level' =>'success', 'flash_message'=> 'Xóa thành công']);
            } else {
                   return redirect('admin/news/list/')->with(['flash_level' =>'danger','flash_message'=>'Lỗi xóa  ']);
            }
        }

    //news  management....................

    //slider  management....................

        public function slider_list(){
            $Slider =  Slider::selectRaw('*')
            ->orderBy('RowID','DESC')
            ->get();

           return view('back.slider.list', compact('Slider'));
        }
        public function slider_getAdd(){

            return view('back.slider.add');
        }

        public function slider_add(Request $request){
            if ($request->Name == ''|| $request->Alias == '' ){
            return redirect('admin/slider/add/')->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 
            $Slider = new Slider;
            $Slider->Status = $request->Status;;
            $Slider->Name = $request->Name;
            $Slider->Alias = $request->Alias;
            $Slider->Sort = $request->Sort;         


            if($request->hasFile('Images')){
                $file = $request->file('Images');
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit.'-'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());

                if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg' ){
                    return back()->with(['flash_level' => 'danger', 'flash_message '=> 'Mở rộng file không được hỗ trợ']);
                }
                $file->move('images/slider',$name);
                
                $img = Image::make('images/slider/'.$name);
                // kiểm tra nếu không tồn tại thì tạo folder
                $filePath = "images/slider/".date('Y');
                if (!file_exists($filePath)){
                    mkdir("images/slider/".date('Y'), 0777, true);
                }
                $img->fit(1899,333);
                $img->save('images/slider/'.date('Y').'/'.$name);
                //xóa  hình tải lên
                if(file_exists('images/slider/'.$name)){
                    unlink('images/slider/'.$name);
                }

                $Slider->Images = date('Y').'/'.$name;

            } 

            $Flag = $Slider->save();

             if ($Flag == true) {
                 return redirect('admin/slider/list')->with(['flash_level' =>'success', 'flash_message'=> 'Thêm  thành công']);
                } else {
                   return redirect('admin/slider/list')->with(['flash_level' =>'danger','flash_message'=>'Lỗi thêm khi thêm Slider']);
                }
        }

        public function slider_getedit(Request $request, $RowID){
            $Slider = Slider::find($RowID);
            return view('back.slider.edit', compact('Slider'));
        }

        public function slider_edit(Request $request, $RowID){
            if ($request->Name == ''|| $request->Alias == '' ){
            return redirect('admin/slider/edit/'.$RowID)->with(['flash_level' => 'danger', 'flash_message' => '  không được bỏ trống thông tin chứa *']); 
            } 
            $Slider = Slider::find($RowID);
            $Slider->Status = $request->Status;;
            $Slider->Name = $request->Name;
            $Slider->Alias = $request->Alias;
            $Slider->Sort = $request->Sort;   

            if($request->hasFile('Images')){
                $file = $request->file('Images');
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit .'-'.$file->getClientOriginalName();
                $duoi = strtolower($file->getClientOriginalExtension());

                 if($duoi != 'png' && $duoi !='jpg' && $duoi !='jpeg' && $duoi !='svg' ){
                    return back()->with(['flash_level' => 'danger', 'flash_message '=> 'Mở rộng file hình ảnh']);
                }
                if($Slider->Images !=''){
                    if(file_exists('images/slider/'.$Slider->Images)){
                        unlink('images/slider/'.$Slider->Images);
                    }
                }
                // up hình ảnh lên sever
                $file->move('images/slider',$name);
                $img = Image::make('images/slider/'.$name);
                // kiểm tra nếu không tồn tại thì tạo folder
                $filePath = "images/slider/".date('Y');
                if (!file_exists($filePath)){
                    mkdir("images/slider/".date('Y'), 0777, true);
                }
                $img->fit(1899,333);
                $img->save('images/slider/'.date('Y').'/'.$name);
                //xóa  hình tải lên
                if(file_exists('images/slider/'.$name)){
                    unlink('images/slider/'.$name);
                }

                $Slider->Images = date('Y').'/'.$name;

            } 



            $Flag = $Slider->save();

             if ($Flag == true) {
                 return redirect('admin/slider/edit/'.$RowID)->with(['flash_level' =>'success', 'flash_message'=> 'Chỉnh sữa  thành công']);
                } else {
                   return redirect('admin/slider/list/'.$RowID)->with(['flash_level' =>'danger','flash_message'=>'Lỗi Chỉnh sữa  tin tức']);
                }
        }

        public function slider_delete(Request $request , $RowID){
            $Slider =  Slider::find($RowID);
            $Flag = $Slider->delete();
            
                if($Slider->Images !=''){
                    if(file_exists('images/slider/'.$Slider->Images)){
                        unlink('images/slider/'.$Slider->Images);
                    }
                }

            if($Flag == true){
                return redirect('admin/slider/list/')->with(['flash_level' =>'success', 'flash_message'=> 'Xóa thành công']);
            } else {
                   return redirect('admin/slider/list/')->with(['flash_level' =>'danger','flash_message'=>'Lỗi xóa  ']);
            }
        }

    //slider  management....................

}


