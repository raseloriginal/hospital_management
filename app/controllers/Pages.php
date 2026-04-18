<?php
  class Pages extends Controller {
    public function __construct(){
      // No forced redirect here to allow guest access to landing page
    }

    public function index(){
      if(isLoggedIn()){
        $this->db = new Database;
        
        // --- COMMAND CENTER STATS ---
        // Total Patients
        $this->db->query("SELECT id FROM patients");
        $total_p = $this->db->rowCount();
        
        // --- DEFENSIVE STATS FETCHING ---
        // Today Appointments
        $this->db->query("SELECT COUNT(id) as count FROM appointments WHERE appointment_date = CURDATE()");
        $today_a_row = $this->db->single();
        $today_a = $today_a_row->count ?? 0;
        
        // Today's Revenue
        $this->db->query("SELECT SUM(amount) as rev FROM payments WHERE DATE(payment_date) = CURDATE()");
        $rev_row = $this->db->single();
        $today_rev = $rev_row->rev ?? 0;
        
        // Total Beds & Available
        $this->db->query("SELECT COUNT(id) as count FROM beds");
        $total_beds_row = $this->db->single();
        $total_beds = $total_beds_row->count ?? 0;

        $this->db->query("SELECT COUNT(id) as count FROM beds WHERE is_available = 1");
        $avail_beds_row = $this->db->single();
        $avail_beds = $avail_beds_row->count ?? 0;

        // Pending Receivables (Unpaid Invoices)
        $this->db->query("SELECT SUM(payable_amount) as total FROM invoices WHERE status != 'Paid'");
        $pending_row = $this->db->single();
        $pending_cash = $pending_row->total ?? 0;

        // --- TREND NORMALIZATION (7 DAYS) ---
        $revenue_trend = [];
        $appointment_trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            
            // Revenue for this day
            $this->db->query("SELECT SUM(amount) as total FROM payments WHERE DATE(payment_date) = :date");
            $this->db->bind(':date', $date);
            $row = $this->db->single();
            $revenue_trend[] = (object)['date' => $date, 'total' => $row->total ?? 0];

            // Appointments for this day
            $this->db->query("SELECT COUNT(id) as count FROM appointments WHERE appointment_date = :date");
            $this->db->bind(':date', $date);
            $row = $this->db->single();
            $appointment_trend[] = (object)['date' => $date, 'count' => $row->count ?? 0];
        }

        // --- RECENT & OPERATIONAL DATA ---
        // Low Stock Inventory
        $this->db->query("SELECT id FROM pharmacy_items WHERE stock_quantity <= 10");
        $low_stock = $this->db->rowCount();
        $this->db->query("SELECT name, stock_quantity FROM pharmacy_items WHERE stock_quantity <= 10 LIMIT 3");
        $low_stock_list = $this->db->resultSet();

        // Recent Appointments
        $this->db->query("SELECT appointments.*, patients.name as patient_name, users.name as doctor_name 
                          FROM appointments 
                          JOIN patients ON appointments.patient_id = patients.id 
                          JOIN doctors ON appointments.doctor_id = doctors.id 
                          JOIN users ON doctors.user_id = users.id 
                          ORDER BY appointments.created_at DESC LIMIT 5");
        $recent_a = $this->db->resultSet();

        // Recent Lab Activity
        $this->db->query("SELECT lab_requests.*, patients.name as patient_name, lab_tests.test_name 
                          FROM lab_requests 
                          JOIN patients ON lab_requests.patient_id = patients.id 
                          JOIN lab_tests ON lab_requests.test_id = lab_tests.id 
                          ORDER BY lab_requests.created_at DESC LIMIT 5");
        $recent_lab = $this->db->resultSet();

        // Department Distribution
        $this->db->query("SELECT department, COUNT(*) as count FROM doctors GROUP BY department");
        $dept_stats = $this->db->resultSet();

        // Available Doctors
        $this->db->query("SELECT doctors.*, users.name, doctors.specialization 
                          FROM doctors 
                          JOIN users ON doctors.user_id = users.id 
                          LIMIT 3");
        $on_duty_d = $this->db->resultSet();

        // Active Admissions
        $this->db->query("SELECT a.*, p.name as patient_name, b.bed_number, w.name as ward_name
                          FROM admissions a
                          JOIN patients p ON a.patient_id = p.id
                          JOIN beds b ON a.bed_id = b.id
                          JOIN wards w ON b.ward_id = w.id
                          WHERE a.status = 'Admitted'
                          ORDER BY a.admission_date DESC LIMIT 5");
        $active_admissions = $this->db->resultSet();

        // --- FINANCIAL ANALYTICS ---
        $this->db->query("SELECT SUM(amount) as total FROM payments");
        $total_rev_row = $this->db->single();
        $total_revenue = $total_rev_row->total ?? 0;

        $this->db->query("SELECT SUM(amount) as total FROM expenses");
        $total_exp_row = $this->db->single();
        $total_expenses = $total_exp_row->total ?? 0;

        $net_profit = $total_revenue - $total_expenses;

        // --- DOCTOR PERFORMANCE ---
        $this->db->query("SELECT u.name, COUNT(a.id) as appointment_count 
                          FROM appointments a 
                          JOIN doctors d ON a.doctor_id = d.id 
                          JOIN users u ON d.user_id = u.id 
                          GROUP BY d.id 
                          ORDER BY appointment_count DESC LIMIT 5");
        $doctor_performance = $this->db->resultSet();

        $data = [
          'title' => 'Clinical Command Center',
          'stats' => [
            'total_patients' => $total_p,
            'today_appointments' => $today_a,
            'today_revenue' => $today_rev,
            'total_beds' => $total_beds,
            'available_beds' => $avail_beds,
            'pending_receivables' => $pending_cash,
            'low_stock_count' => $low_stock,
            'net_profit' => $net_profit,
            'total_revenue' => $total_revenue,
            'total_expenses' => $total_expenses
          ],
          'low_stock_list' => $low_stock_list,
          'recent_appointments' => $recent_a,
          'recent_lab' => $recent_lab,
          'dept_stats' => $dept_stats,
          'on_duty_doctors' => $on_duty_d,
          'revenue_trend' => $revenue_trend,
          'appointment_trend' => $appointment_trend,
          'active_admissions' => $active_admissions,
          'doctor_performance' => $doctor_performance
        ];

        $this->view('pages/index', $data);
      } else {
        // --- GUEST LANDING PAGE LOGIC ---
        $this->db = new Database;
        
        $this->db->query("SELECT id FROM doctors");
        $doctors_count = $this->db->rowCount();
        
        $this->db->query("SELECT id FROM patients");
        $patients_count = $this->db->rowCount();

        $this->db->query("SELECT id FROM beds");
        $beds_count = $this->db->rowCount();

        $this->db->query("SELECT DISTINCT department FROM doctors");
        $departments = $this->db->resultSet();

        $data = [
          'title' => 'Welcome',
          'stats' => [
            'doctors' => $doctors_count,
            'patients' => $patients_count,
            'beds' => $beds_count,
            'departments' => count($departments)
          ],
          'dept_list' => $departments
        ];

        $this->view('pages/landing', $data);
      }
    }
  }
