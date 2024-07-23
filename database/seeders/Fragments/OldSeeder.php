<?php
namespace Database\Seeders\Fragments;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('g59_budgets')->insert([
            'budget_type' => 'T1',
            'budget_department' => 1004,
            'budget_amount' => 10000,
            'budget_name' => 'Marketing Conference',
            'budget_description' => 'Attend marketing conference in San Francisco',
            'budget_category' => 'C7',
            'budget_startDate' => '2023-10-04',
            'budget_endDate' => '2023-10-06',
            'budget_approvedAmount' => 9500,
            'budget_notes' => '',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'johnrey.miranda',
            'budget_approvedDate' => '2023-10-03',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_budgets')->insert([
            'budget_type' => 'T1',
            'budget_department' => 1002,
            'budget_amount' => 5000,
            'budget_name' => 'New Sales Software',
            'budget_description' => 'Purchase new sales software for the sales team',
            'budget_category' => 'C4',
            'budget_startDate' => '2023-10-10',
            'budget_endDate' => '2023-10-31',
            'budget_approvedAmount' => 5200,
            'budget_notes' => 'Additional costs for training and implementation',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'jasonryan.odvina',
            'budget_approvedDate' => '2023-10-09',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_budgets')->insert([
            'budget_type' => 'T1',
            'budget_department' => 1003,
            'budget_amount' => 2000,
            'budget_name' => 'New Servers',
            'budget_description' => 'Purchase new servers to support the growing company',
            'budget_category' => 'C3',
            'budget_startDate' => '2023-10-17',
            'budget_endDate' => '2023-11-15',
            'budget_approvedAmount' => 2500,
            'budget_notes' => 'Unexpected increase in server costs',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'johnrey.miranda',
            'budget_approvedDate' => '2023-10-16',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_budgets')->insert([
            'budget_type' => 'T1',
            'budget_department' => 1004,
            'budget_amount' => 1500,
            'budget_name' => 'Employee Training',
            'budget_description' => 'Provide employee training on new company policies and procedures',
            'budget_category' => 'C1',
            'budget_startDate' => '2023-10-24',
            'budget_endDate' => '2023-11-30',
            'budget_approvedAmount' => 1200,
            'budget_notes' => 'Fewer employees attended training than expected',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'jasonryan.odvina',
            'budget_approvedDate' => '2023-10-23',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_budgets')->insert([
            'budget_type' => 'T1',
            'budget_department' => 1002,
            'budget_amount' => 1000,
            'budget_name' => 'Office Supplies',
            'budget_description' => 'Purchase office supplies for the company',
            'budget_category' => 'C8',
            'budget_startDate' => '2023-10-31',
            'budget_endDate' => '2023-11-30',
            'budget_approvedAmount' => 900,
            'budget_notes' => 'Lower-than-expected office supply usage',
            'budget_status' => 'S1',
            'budget_approvedBy' => 'johnrey.miranda',
            'budget_approvedDate' => '2023-10-30',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_add_budgets_request')->insert([

            'request_name' => 'Conference',
            'request_amount' => 20000,
            'request_description' => 'Attend marketing conference in San Angelo',
            'request_category' => 'C7',
            'request_type' => 'T2',
            'request_department' => 1004,
            'request_budget_code' => 1,
            'request_actualSpending' => 30000,
            'request_variance' => 20000,
            'request_varianceReason' => 'Conference',
            'request_status' => 'S1',
            'request_approvedBy' => 'johnrey.miranda',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => 20000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_add_budgets_request')->insert([

            'request_name' => 'Old Sales Software',
            'request_amount' => 5000,
            'request_description' => 'Purchase new sales software for the sales team',
            'request_category' => 'C4',
            'request_type' => 'T2',
            'request_department' => 1002,
            'request_budget_code' => 2,
            'request_actualSpending' => 6000,
            'request_variance' => 11000,
            'request_varianceReason' => 'Additional costs for training and implementation',
            'request_status' => 'S1',
            'request_approvedBy' => 'jasonryan.odvina',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => 5000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_add_budgets_request')->insert([

            'request_name' => 'New Server',
            'request_amount' => 5000,
            'request_description' => 'Purchase new servers to support the growing company',
            'request_category' => 'C3',
            'request_type' => 'T2',
            'request_department' => 1003,
            'request_budget_code' => 3,
            'request_actualSpending' => 6000,
            'request_variance' => 1100,
            'request_varianceReason' => 'Unexpected increase in server costs',
            'request_status' => 'S1',
            'request_approvedBy' => 'jasonryan.odvina',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => 5000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Adjustments for Non-Cash Items',
            'cashflow_amount' => 5000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS01',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Changes in Working Capital',
            'cashflow_amount' => 3000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS01',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Net Cash Provided by Operating Activities',
            'cashflow_amount' => 28000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS01',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Purchase of Equipment',
            'cashflow_amount' => 10000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS02',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Net Cash Used in Investing Activities',
            'cashflow_amount' => 10000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS02',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Repayment of Loans',
            'cashflow_amount' => 5000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS03',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Net Cash Used in Financing Activities',
            'cashflow_amount' => 5000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS03',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Net Increase in Cash',
            'cashflow_amount' => 13000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS03',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Beginning Cash Balance',
            'cashflow_amount' => 50000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS03',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('g59_cashflow_statement')->insert([
            'cashflow_info' => 'CF001',
            'cashflow_name' => 'Ending Cash Balance',
            'cashflow_amount' => 63000,
            'cashflow_date' => '2020-01-01',
            'cashflow_type' => 'T3',
            'cashflow_department' => 1003,
            'cashflow_category' => 'CFS03',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        DB::table('g59_income_statement')->insert([
            'income_info' => 'IN001',
            'income_name' => 'Sales Revenue',
            'income_amount' => 150000,
            'income_date' => '2020-01-01',
            'income_type' => 'T4',
            'income_department' => 1002,
            'income_category' => 'INC01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_income_statement')->insert([
            'income_info' => 'IN001',
            'income_name' => 'Cost of Goods Sold',
            'income_amount' => 75000,
            'income_date' => '2020-01-01',
            'income_type' => 'T4',
            'income_department' => 1002,
            'income_category' => 'INC01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_income_statement')->insert([
            'income_info' => 'IN001',
            'income_name' => 'Gross Profit',
            'income_amount' => 75000,
            'income_date' => '2020-01-01',
            'income_type' => 'T4',
            'income_department' => 1002,
            'income_category' => 'INC01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_income_statement')->insert([
            'income_info' => 'IN001',
            'income_name' => 'Salaries and Wages',
            'income_amount' => 40000,
            'income_date' => '2020-01-01',
            'income_type' => 'T4',
            'income_department' => 1002,
            'income_category' => 'INC02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_income_statement')->insert([
            'income_info' => 'IN001',
            'income_name' => 'Rent Expense',
            'income_amount' => 10000,
            'income_date' => '2020-01-01',
            'income_type' => 'T4',
            'income_department' => 1002,
            'income_category' => 'INC02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_income_statement')->insert([
            'income_info' => 'IN001',
            'income_name' => 'Marketing expenses',
            'income_amount' => 5000,
            'income_date' => '2020-01-01',
            'income_type' => 'T4',
            'income_department' => 1002,
            'income_category' => 'INC02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Cash',
            'balance_amount' => 100000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Accounts Receivable',
            'balance_amount' => 50000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Inventory',
            'balance_amount' => 25000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Fixed Assets',
            'balance_amount' => 75000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Total Assets',
            'balance_amount' => 250000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Total Liabilities',
            'balance_amount' => 250000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Shareholder\'s Equity',
            'balance_amount' => 180000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS03',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Total Equity',
            'balance_amount' => 180000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS03',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_balance_sheet')->insert([
            'balance_info' => 'BS001',
            'balance_name' => 'Total Liabilities and Equity',
            'balance_amount' => 250000,
            'balance_date' => '2020-01-01',
            'balance_type' => 'T5',
            'balance_department' => 1003,
            'balance_category' => 'BS03',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_accounts_payable')->insert([
            'payable_info' => 'AP001',
            'payable_name' => 'ABC Company',
            'payable_amount' => 3000,
            'payable_date' => '2024-01-15',
            'payable_type' => 'T6',
            'payable_department' => 1004,
            'payable_category' => 'AP01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_accounts_payable')->insert([
            'payable_info' => 'AP001',
            'payable_name' => 'XYZ Company',
            'payable_amount' => 5000,
            'payable_date' => '2023-12-20',
            'payable_type' => 'T6',
            'payable_department' => 1004,
            'payable_category' => 'AP02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_accounts_payable')->insert([
            'payable_info' => 'AP001',
            'payable_name' => 'DEF Company',
            'payable_amount' => 8000,
            'payable_date' => '2023-11-28',
            'payable_type' => 'T6',
            'payable_department' => 1004,
            'payable_category' => 'AP03',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_accounts_recievable')->insert([
            'recievable_info' => 'AR001',
            'recievable_name' => 'ABC Company',
            'recievable_invoice_date' => '2024-01-10',
            'recievable_amount' => 5000,
            'recievable_due_date' => '30',
            'recievable_type' => 'T7',
            'recievable_department' => 1003,
            'recievable_category' => 'AR01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_accounts_recievable')->insert([
            'recievable_info' => 'AR001',
            'recievable_name' => 'XYZ Company',
            'recievable_invoice_date' => '2024-02-05',
            'recievable_amount' => 2000,
            'recievable_due_date' => '15',
            'recievable_type' => 'T7',
            'recievable_department' => 1003,
            'recievable_category' => 'AR02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_accounts_recievable')->insert([
            'recievable_info' => 'AR001',
            'recievable_name' => 'DEF Company',
            'recievable_invoice_date' => '2024-03-15',
            'recievable_amount' => 10000,
            'recievable_due_date' => '60',
            'recievable_type' => 'T7',
            'recievable_department' => 1003,
            'recievable_category' => 'AR03',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_inventory_turnover')->insert([
            'turnover_info' => 'IT001',
            'turnover_product_name' => 'Product A',
            'turnover_cost_of_goods_sold' => 5000,
            'turnover_inventory_turnover_ratio' => 5,
            'turnover_date' => '2020-01-01',
            'turnover_type' => 'T8',
            'turnover_department' => 1002,
            'turnover_category' => 'IT02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_inventory_turnover')->insert([
            'turnover_info' => 'IT001',
            'turnover_product_name' => 'Product B',
            'turnover_cost_of_goods_sold' => 10000,
            'turnover_inventory_turnover_ratio' => 5,
            'turnover_date' => '2020-01-01',
            'turnover_type' => 'T8',
            'turnover_department' => 1002,
            'turnover_category' => 'IT04',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_inventory_turnover')->insert([
            'turnover_info' => 'IT001',
            'turnover_product_name' => 'Product C',
            'turnover_cost_of_goods_sold' => 2500,
            'turnover_inventory_turnover_ratio' => 5,
            'turnover_date' => '2020-01-01',
            'turnover_type' => 'T8',
            'turnover_department' => 1002,
            'turnover_category' => 'IT01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('g59_sales_report')->insert([
            'sales_info' => 'SR001',
            'sales_product_name' => 'Product A',
            'sales_revenue' => 5000,
            'sales_date' => '2020-01-01',
            'sales_type' => 'T9',
            'sales_department' => 1002,
            'sales_category' => 'SR02',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_sales_report')->insert([
            'sales_info' => 'SR001',
            'sales_product_name' => 'Product B',
            'sales_revenue' => 10000,
            'sales_date' => '2020-01-01',
            'sales_type' => 'T9',
            'sales_department' => 1002,
            'sales_category' => 'SR04',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('g59_sales_report')->insert([
            'sales_info' => 'SR001',
            'sales_product_name' => 'Product C',
            'sales_revenue' => 2500,
            'sales_date' => '2020-01-01',
            'sales_type' => 'T9',
            'sales_department' => 1002,
            'sales_category' => 'SR01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
