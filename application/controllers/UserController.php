<?php 

class UserController extends CI_controller
{
	public function index()
	{
        $data['allCategory'] = $this->db->limit(9)->order_by('i_c_id','DESC')->get('item_category')->result_array();
        $data['allCategory_filter'] = $this->db->limit(9)->order_by('i_c_id','DESC')->get('item_category')->result_array();

        $data['all_courses'] = $this->db
            ->order_by('c_id', 'DESC')
//            ->limit(6)
            ->join('item_category','item_category.i_c_id = items2.category','left')
            ->join('items3','items3.t_id = items2.teacher','left')
            ->join('status','status.s_id = items2.status','left')
            ->get('items2')->result_array();

//        print_r('<pre>');
//        print_r($data['all_courses']);
//        die();

		$this->load->view('user/index',$data);
	}

    public function sign_in()
    {
        $this->load->view('user/sign-in');
    }

    public function sign_up()
    {
        $this->load->view('user/sign-up');
    }
	
//	public function single()
//	{
//		$this->load->view('user/single-page');
//	}

	public function contact()
	{
		$this->load->view('user/contact');
	}

    public function about()
    {
        $this->load->view('user/about');
    }

    public function error404()
    {
        $this->load->view('user/error');
    }

    public function blog()
    {
        $this->load->view('user/blog');
    }

    public function blog_single($id)
    {
        $this->load->view('user/blog-details');
    }

    public function category_list()
    {
        $data['allCategory'] = $this->db->order_by('i_c_id','DESC')->get('item_category')->result_array();
        $this->load->view('user/category_list',$data);
    }

    public function category($id)
    {
        $data['category'] = $this->db
            ->order_by('c_id', 'DESC')
            ->where('category',$id)
            ->join('item_category','item_category.i_c_id = items2.category','left')
            ->join('items3','items3.t_id = items2.teacher','left')
            ->join('status','status.s_id = items2.status','left')
            ->get('items2')->result_array();

//        print_r('<pre>');
//        print_r($data['category']);
//        die();
        $this->load->view('user/category',$data);
    }

    public function courses()
    {
        $data['all_courses'] = $this->db
            ->order_by('c_id', 'DESC')
            ->join('item_category','item_category.i_c_id = items2.category','left')
            ->join('items3','items3.t_id = items2.teacher','left')
            ->join('status','status.s_id = items2.status','left')
            ->get('items2')->result_array();
        $this->load->view('user/course-grid', $data);
    }

    public function course_single($id){
        $data['single_course'] = $this->db
            ->where('c_id',$id)
            ->join('item7_course_programm','item7_course_programm.prog_course_id = items2.c_id','left')
            ->join('item_category','item_category.i_c_id = items2.category','left')
            ->join('items3','items3.t_id = items2.teacher','left')

            ->get('items2')->row_array();


        $data['all_courses_same_category_courses'] = $this->db
            ->order_by('c_id', 'DESC')
            ->where_not_in('c_id', $id)
            ->where('category',$data['single_course']['category'])
            ->join('item_category','item_category.i_c_id = items2.category','left')
            ->join('items3','items3.t_id = items2.teacher','left')
            ->get('items2')->result_array();

        $data['all_courses'] = $this->db
            ->order_by('c_id', 'DESC')
            ->where_not_in('c_id', $id)
            ->join('item_category','item_category.i_c_id = items2.category','left')
            ->join('items3','items3.t_id = items2.teacher','left')
            ->join('status','status.s_id = items2.status','left')
            ->get('items2')->result_array();

//        print_r('<pre>');
//        print_r($data['all_courses']);
//        die();

        $data['programs'] = $this->db
            ->where('prog_course_id',$id)
            ->join('items2','items2.c_id = item7_course_programm.prog_course_id','left')
            ->get('item7_course_programm')->result_array();



        $data['teachers'] = $this->db->order_by('t_id','DESC')->limit(4)->get('items3')->result_array();

//        print_r("<pre>");
//        print_r($data['teachers']);
//        die();

        $this->load->view('user/course-details',$data);
    }

    public function instructor(){
        $data['all_teachers'] = $this->db->order_by('t_id','DESC')->get('items3')->result_array();
        $this->load->view('user/instructor',$data);
    }

    public function instructor_single($id){
        $data['single_teacher'] = $this->db->where('t_id',$id)->get('items3')->row_array();

        $data['all_courses'] = $this->db
            ->where('t_id', $id)
            ->order_by('c_id', 'DESC')
            ->where_not_in('c_id', $id)
            ->join('item_category','item_category.i_c_id = items2.category','left')
            ->join('items3','items3.t_id = items2.teacher','left')
            ->join('status','status.s_id = items2.status','left')
            ->get('items2')->result_array();
//        print_r("<pre>");
//        print_r($data['all_courses']);
//        die();

        $this->load->view('user/instructor-details',$data);
    }


    public function events()
    {
//        $data = $this->db->oreder_by('ce','DESC')->get('items8')->result_array();

        $this->load->view('user/events');
    }









}




