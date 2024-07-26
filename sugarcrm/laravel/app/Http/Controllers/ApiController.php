<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Api"
 * )
 */

class ApiController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/module/lt_case/create",
     *     summary="Creates a case",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="first_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="last_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 @OA\Property(
     *                     property="id_number",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"first_name": "Nelson", "last_name": "Mandela", "phone": "0123456789", "id_number": "1807180000000"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function createCase(Request $request) {
        $validator = Validator::make($request->all(), [
            "policy_id" => "required_without:customer_id",
            "customer_id" => "required_without:policy_id",
            "type" => "required|in:increase_cover, decrease_cover, cancel_cover",
            "name" => "required",
            "description" => "required"
        ]);

        $case = new \lt_case();
        $validated = $validator->validated();
        foreach( $validated as $inputName => $inputValue ) {
            if ( in_array($inputValue, ["type", "name", "description"]) ) {
                $case->{$inputName} = $inputValue;
            }
        }
        $case->save();

        return response()->json($case);
    }

    /**
     * @OA\Get(
     *     path="/api/module/lt_case/get/{id}",
     *     summary="Gets a case",
     *     @OA\Parameter(
     *         description="",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number"),
     *         @OA\Examples(example="int", value="1", summary="Case 1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function getCase($id) {
        $case = new \lt_case();
        $case->retrieve($id);

        if ( empty($case->id) ) {
            throw new \Exception("Case not found!");
        }

        $case->customers = $case->get_linked_beans('lt_customer');
        $case->policies = $case->get_linked_beans('lt_policy');
        $case->cases = $case->get_linked_beans('lt_case');
        return response()->json($case);
    }

    /**
     * @OA\Post(
     *     path="/api/module/lt_customer/create",
     *     summary="Creates a customer",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="first_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="last_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 @OA\Property(
     *                     property="id_number",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"first_name": "Nelson", "last_name": "Mandela", "phone": "0123456789", "id_number": "1807180000000"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function createCustomer(Request $request) {

        $validator = Validator::make($request->all(), [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "phone" => "required",
            "id_number" => "required|unique:lt_customer"
        ]);

        if ( $validator->fails() ) {
            $errors = $validator->errors();
            $errorMessages = $errors->all();

            throw new \Exception("Validation failed: " . implode("\n", $errorMessages));
        } else {
            $validated = $validator->validated();

            $customer = new \lt_customer();

            foreach( $validated as $inputName => $inputValue) {
                $customer->{$inputName} = $inputValue;
            }

            $customer->save();

            return response()->json($customer);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/module/lt_customer/get/{id}",
     *     summary="Gets a customer",
     *     @OA\Parameter(
     *         description="",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number"),
     *         @OA\Examples(example="int", value="1", summary="Customer 1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function getCustomer($id) {
        $customer = new \lt_customer();
        $customer->retrieve($id);
        $customer->policies = $customer->get_linked_beans('lt_policy');
        $customer->cases = $customer->get_linked_beans('lt_case');
        return response()->json($customer);
    }

    /**
     * @OA\Put(
     *     path="/api/module/lt_case/{id}/remove-customer",
     *     summary="Removes a customer from a case",
     *     @OA\Parameter(
     *         description="Case id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number"),
     *         @OA\Examples(example="int", value="1", summary="Case 1")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="id_number",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"id_number": "1807180000000"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function removeCustomerFromCase(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            "id_number" => "required"
        ]);

        if ( $validator->fails() ) {
            $errors = $validator->errors();
            $errorMessages = $errors->all();
            throw new \Exception("Validation failed: " . implode("\n", $errorMessages));
        } else {
            $validated = $validator->validated();
            $case = new \lt_case();
            $case->retrieve($id);
            if ( empty($case->id) ) {
                throw new \Exception("Case with id `{$id}` not found!");
            }
            $case->load_relationship("lt_customer");

            $customer = new \lt_customer();
            $customer->retrieve_by_string_fields(['id_number' => $validated['id_number']]);
            if ( empty($customer->id) ) {
                throw new \Exception("Customer with id number `{$validated['id_number']}` not found!");
            }

            $case->lt_customer->remove($customer);
        }

        return $this->getCase($id);
    }

    /**
     * @OA\Put(
     *     path="/api/module/lt_case/{id}/add-customer",
     *     summary="Adds a customer to a case",
     *     @OA\Parameter(
     *         description="Case id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number"),
     *         @OA\Examples(example="int", value="1", summary="Case 1")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="id_number",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"id_number": "1807180000000"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function addCustomerToCase(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            "id_number" => "required"
        ]);

        if ( $validator->fails() ) {
            $errors = $validator->errors();
            $errorMessages = $errors->all();
            throw new \Exception("Validation failed: " . implode("\n", $errorMessages));
        } else {
            $validated = $validator->validated(); //The id number is here: $validated['id_number']

            $case = new \lt_case();
            $case->retrieve($id);
            if ( empty($case->id) ) {
                throw new \Exception("Case with id `{$id}` not found!");
            }
            $case->load_relationship("lt_customer");

            $customer = new \lt_customer();
            $customer->retrieve_by_string_fields(['id_number' => $validated['id_number']]);
            if ( empty($customer->id) ) {
                throw new \Exception("Customer with id number `{$validated['id_number']}` not found!");
            }

            $case->lt_customer->add($customer);
        }

        return $this->getCase($id);
    }

    /**
     * @OA\Get(
     *     path="/api/lists/customers",
     *     summary="Gets list of customers showing first_name, last_name and id_number",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function getCustomers(Request $request) {
        $results = DB::select(<<<SQL
            SELECT last_name, first_name, id_number
            FROM lt_customer
            ORDER BY last_name
SQL);
        return response()->json($results);
    }

    /**
     * @OA\Get(
     *     path="/api/lists/customers/with-policy-names",
     *     summary="Gets list of customers showing first_name, last_name, id_number and a concatinated list of policy names",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function getCustomersWithPolicyNames(Request $request) {
        $results = [];
        $results = DB::select("
            SELECT
                c.last_name,
                c.first_name,
                c.id_number,
                GROUP_CONCAT(p.name SEPARATOR ', ') AS policy_names
            FROM
                lt_customer AS c
            LEFT JOIN
                lt_policy AS p ON c.id = p.customer_id
            GROUP BY
                c.id, c.last_name, c.first_name, c.id_number
        ");

        return response()->json($results);
    }

    /**
     * @OA\Put(
     *     path="/api/lists/customers/update-id-number-status",
     *     summary="Updates the status of an id number based on the id number that's currently stored for each customer",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function updateHasCorrectIdNumber(Request $request) {

        DB::update("
            UPDATE lt_customer
            SET id_number_status = CASE
                WHEN id_number LIKE '% %' THEN 'uncertain'
                WHEN LENGTH(id_number) = 13 THEN 'correct'
                ELSE 'incorrect'
            END
        ");

        return $this->getCustomers($request);
    }

        /**
     * @OA\Put(
     *     path="/api/lists/customers/update-id-number-status",
     *     summary="Updates the status of an id number based on the id number that's currently stored for each customer",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    function getCourses(Request $request) {

        $results = DB::select("
                        SELECT
                            c.id AS course_id,
                            c.name AS course_name,
                            c.description AS course_description,
                            JSON_OBJECT(
                                'teacher_id', t.id,
                                'teacher_name', t.name
                            ) AS teacher,
                            JSON_ARRAYAGG(
                                JSON_OBJECT(
                                    'student_id', s.id,
                                    'student_name', s.name
                                )
                            ) AS students
                        FROM
                            lt_course c
                        JOIN
                            lt_teacher t ON c.teacher_id = t.id
                        LEFT JOIN
                            course_student cs ON c.id = cs.course_id
                        LEFT JOIN
                            lt_student s ON cs.student_id = s.id
                        GROUP BY
                            c.id, t.id, c.name, c.description
        ");

        return response()->json($results);
    }
}
