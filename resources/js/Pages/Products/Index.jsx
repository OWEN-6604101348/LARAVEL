import { Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Index({ products }) {
    return (
            <div className="container mx-auto px-4 py-6">
                <h1 className="text-3xl font-semibold text-center mb-8">รายการสินค้า</h1>
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    {products.map((product) => (
                        <div
                            key={product.id}
                            className="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105 duration-300 flex flex-col h-full"
                        >
                            <Link href={`/products/${product.id}`} className="block h-full">
                                {/* รูปภาพ */}
                                <div className="overflow-hidden rounded-t-lg">
                                    <img
                                        src={product.image ? product.image : '/default-image.jpg'}
                                        alt={product.name}
                                        className="w-full h-48 object-cover"
                                    />
                                </div>

                                {/* รายละเอียดสินค้า */}
                                <div className="p-4 flex-grow">
                                    <h2 className="text-lg font-semibold text-gray-800 hover:text-blue-600 mb-2">
                                        {product.name}
                                    </h2>
                                    <p className="text-gray-600 text-sm mb-4">{product.description}</p>
                                    <p className="text-lg font-bold text-gray-900">ราคา: ${product.price}</p>
                                </div>
                            </Link>
                        </div>
                    ))}
                </div>
            </div>
    );
}
