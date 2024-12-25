import React, { useState, useEffect } from 'react';
import { Link } from '@inertiajs/react';

export default function Index({ employees, query }) {
    // State สำหรับเก็บค่าการค้นหา
    const [searchQuery, setSearchQuery] = useState(query || '');
    const [debouncedQuery, setDebouncedQuery] = useState(searchQuery);

    // ใช้ useEffect สำหรับการดีเลย์ search
    useEffect(() => {
        const timeoutId = setTimeout(() => setDebouncedQuery(searchQuery), 500);
        return () => clearTimeout(timeoutId);
    }, [searchQuery]);

    // ฟังก์ชันจัดการการค้นหา
    const handleSearch = (e) => setSearchQuery(e.target.value);

    // ฟิลเตอร์ข้อมูล (เฉพาะ 10 คนแรก)
    const filteredEmployees = employees?.data
        ?.filter((employee) => {
            const fullName = `${employee.first_name} ${employee.last_name || ''}`.toLowerCase();
            return fullName.includes(debouncedQuery.toLowerCase());
        })
        ?.slice(0, 10) || [];  // เลือกแค่ 10 คนแรก

    return (
        <div className="max-w-7xl mx-auto p-6">
            {/* หัวข้อของหน้าจอ */}
            <h1 className="text-4xl font-semibold text-center text-gray-800 mb-8">Employee List</h1>

            {/* ช่องกรอกคำค้นหา */}
            <div className="mb-6">
                <input
                    type="text"
                    value={searchQuery}
                    onChange={handleSearch}
                    placeholder="Search by name..."
                    className="w-full p-2 border border-gray-300 rounded-md"
                    aria-label="Search for employees"
                />
            </div>

            {/* ตารางแสดงรายชื่อพนักงาน */}
            <div className="bg-white shadow-md rounded-lg p-4 mb-6">
                {filteredEmployees.length > 0 ? (
                    <table className="min-w-full table-auto">
                        <thead className="bg-gray-200">
                            <tr>
                                <th className="px-4 py-2 text-left">Employee No.</th>
                                <th className="px-4 py-2 text-left">First Name</th>
                                <th className="px-4 py-2 text-left">Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            {filteredEmployees.map((employee) => (
                                <tr key={employee.emp_no} className="border-b border-gray-300">
                                    <td className="px-4 py-2">{employee.emp_no}</td>
                                    <td className="px-4 py-2">{employee.first_name}</td>
                                    <td className="px-4 py-2">
                                        {employee.last_name || 'NO LastName'}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                ) : (
                    <p className="text-center text-gray-500">No employees found.</p>
                )}
            </div>

            {/* ปุ่ม Pagination */}
            <div className="pagination-wrapper mt-4">
                <Pagination links={employees?.links} />
            </div>
        </div>
    );
}

// Pagination Component
function Pagination({ links }) {
    if (!links || links.length === 0) return null;

    return (
        <nav className="pagination-nav" aria-label="Pagination">
            <ul className="flex justify-center space-x-2">
                {links.map((link, index) => (
                    <li
                        key={index}
                        className={`page-item ${
                            link.active ? 'bg-blue-600 text-white' : 'bg-white text-blue-600'
                        } rounded-md`}
                    >
                        <Link
                            href={link.url || '#'}
                            className="page-link px-4 py-2 border border-blue-600 rounded-md transition-all hover:bg-blue-100"
                            aria-label={`Go to page ${link.label}`}
                        >
                            {link.label}
                        </Link>
                    </li>
                ))}
            </ul>
        </nav>
    );
}
