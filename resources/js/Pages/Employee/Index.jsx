
import { Link } from '@inertiajs/react';
export default function Index({ employees }) {
    return (
        <>
            <h1>Employee List</h1>
            <div>
                <ul>
                    {employees.map((employee, index) => (
                        <li key={index}>{employee.first_name}</li>
                    ))}
                </ul>
            </div>
        </>
    );
}