import React from "react";
import { Pagination } from "@mantine/core";
import { ProductsContext } from "./context";
import styles from "./index.module.css";
import Product from "./product";
const List = () => {
    return (
        <ProductsContext.Consumer>
            {({ products, loading, current, fetchNext }) => {
                if (products <= 0) {
                    return <div>No Products Available</div>;
                }
                return (
                    <div>
<section className="py-12">
  <div className="container-fluid max-w-screen-xl mx-auto px-0">
    <div className="flex flex-col md:flex-row -mx-4">
      <aside className="md:w-1/3 lg:w-1/4 px-4">
        {/* filter wrap */}
        <a className="md:hidden mb-5  w-full text-center px-4 py-2 inline-block text-lg text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:text-blue-600" href="#"> 
          Filter by
        </a>
        <div className="hidden md:block px-6 py-4 border border-gray-200 bg-white rounded shadow-sm">
          <h3 className="font-semibold mb-2">Category</h3>
          <ul className="text-gray-500 space-y-1">
            <li><a style={{color: "#6f3c96"}} className="hover:text-gray-600 hover:underline" href="#">Electronics </a></li> 
            <li><a style={{color: "#6f3c96"}} className="hover:text-gray-600 hover:underline" href="#">Watches </a></li> 
            <li><a style={{color: "#6f3c96"}} className="hover:text-gray-600 hover:underline" href="#">Cinema </a></li> 
            <li><a style={{color: "#6f3c96"}} className="hover:text-gray-600 hover:underline" href="#">Clothes </a></li> 
            <li><a style={{color: "#6f3c96"}} className="hover:text-gray-600 hover:underline" href="#">Home items </a></li> 
            <li><a style={{color: "#6f3c96"}} className="hover:text-gray-600 hover:underline" href="#">Smartwatches </a></li> 
          </ul>
          <hr className="my-4" />
          <h3 className="font-semibold mb-2">Filter by</h3>
          <ul className="space-y-1">
            <li>
              <label className="flex items-center">
                <input name type="checkbox" defaultChecked className="h-4 w-4" />
                <span className="ml-2 text-gray-500"> Samsung </span>
              </label>
            </li>
            <li>
              <label className="flex items-center">
                <input name type="checkbox" defaultChecked className="h-4 w-4" />
                <span className="ml-2 text-gray-500"> Huawei </span>
              </label>
            </li>
            <li>
              <label className="flex items-center">
                <input name type="checkbox" className="h-4 w-4" />
                <span className="ml-2 text-gray-500"> Tesla model </span>
              </label>
            </li>
            <li>
              <label className="flex items-center">
                <input name type="checkbox" className="h-4 w-4" />
                <span className="ml-2 text-gray-500"> Best brand </span>
              </label>
            </li>
            <li>
              <label className="flex items-center">
                <input name type="checkbox" className="h-4 w-4" />
                <span className="ml-2 text-gray-500"> Other brands </span>
              </label>
            </li>
          </ul>
        </div>
        {/* filter wrap */}
      </aside> {/* col.// */}
      <main className="md:w-2/3 lg:w-3/4 px-4">
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4">

                            {products.map((product) => {
                                return (
                                    <Product key={product.id} prod={product} />
                                );
                            })}
 
        </div> {/* grid .// */}
        { current.to !== current.total? <div className="flex items-center my-5 justify-center" onClick={() => fetchNext()}>
    <button type="button" style={{backgroundColor: "#6f3c96"}} className="inline-flex items-center px-4 py-2 text-md font-semibold leading-6 text-white transition duration-150 ease-in-out bg-indigo-500 rounded-md shadow cursor-not-allowed hover:bg-indigo-400" disabled={loading}>
      {loading? <svg className="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle className="opacity-25" cx={12} cy={12} r={10} stroke="currentColor" strokeWidth={4} />
        <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
        </path>
      </svg> : ""}
      {loading? "Loading..." : "Load More"}
    </button>
  </div> : ""}
      </main>  {/* col.// */}
    </div> {/* grid.// */}
  
  </div> {/* container .// */}
</section>


                        {/* <div className={styles.productList}>
                            {products.map((product) => {
                                return (
                                    <Product key={product.id} prod={product} />
                                );
                            })}
                        </div>
                        <Pagination
                            className={styles.paginationAction}
                            total={products.length}
                        /> */}
                    </div>
                );
            }}
        </ProductsContext.Consumer>
    );
};

export default List;
