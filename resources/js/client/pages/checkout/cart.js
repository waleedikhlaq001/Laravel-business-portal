/**
 * External Dependencies
 */
import React, { useReducer, useEffect, useState, useLayoutEffect } from "react";
/**
 * Internal Dependencies
 */
import { CartContext } from "./context";
import reducer from "./reducer";
import {
    ADD_PRODUCT,
    REMOVE_PRODUCT,
    EMPTY_CART,
    UPDATE_CART,
    REFRESH_CART,
    UPDATE_CART_SUBTOTAL,
    UPDATE_PRODUCT_PROPERTY,
    UPDATE_QTY,
} from "../../constants";
// import data from "./data.json";

const Cart = ({ cartContent, nextStep }) => {
    console.log("cart comp prop > ", cartContent);
    const [state, dispatch] = useReducer(reducer, cartContent);
    const [products, setProducts] = useState(cartContent.cart);
    useEffect(() => {
        dispatch({ type: UPDATE_CART_SUBTOTAL });
    }, [products]);

    const onQtyChange = (value, index) => {
        dispatch({
            type: UPDATE_QTY,
            payload: { value, index },
        });

        dispatch({ type: UPDATE_CART_SUBTOTAL });
    };

    return (
        <CartContext.Consumer>
            {({ updateCart }) => {
                return (
                    <div>
                        <div className="container-fluid mt-5 p-3 rounded cart">
  <div className="row no-gutters">
    <div className="col-md-8">
      <div className="product-details mr-2">
        <div className="d-flex flex-row align-items-center" onClick={()=>window.location.href = "/products"} style={{cursor: "pointer"}}><i className="fa fa-long-arrow-left" /><span className="ml-2">Continue Shopping</span></div>
        <hr />
        <h3 className="mb-0">Shopping cart</h3>
        <div className="d-flex justify-content-between">{state.count > 0 && (<span>You have {state.count} items in your cart</span>)} {state.count == 0 && (<span>Your Cart is Currently Empty</span>)}
        </div>
        {state.count == 0 && (
                                            <div className="d-flex justify-content-center py-5 align-items-center mt-3 p-2 items rounded">
                                            <div><img src="/images/empty_cart.svg" style={{height: 300}} />
                                            <p className="text-muted mt-3 mb-3">Empty Cart</p>
                                            </div>
                                            </div>
        )}
        {state.count > 0 && (
        <>
        {products.length >
        0 && (
        <>
            {products.map(
                (
                    product,
                    index
                ) => (
        <div className="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
          <div className="d-flex flex-row"><img className="img-thumbnail rounded" src={product.image && JSON.parse(product.image)[0]? "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/" + JSON.parse(product.image)[0] :
                  "/img/empty.png"} width={40} height={40} />
            <div className="ml-2"><span className="font-weight-bold d-block">{product.name}</span><span className="spec">{product.vendor}</span></div>
          </div>
          <div className="d-flex flex-row align-items-center"><span className="d-block">
          <input
                id={
                    index
                }
                key={
                    index
                }
                type="number"
                min="1"
                className="form-control form-control-sm text-center"
                defaultValue="1"
                onChange={(
                    e
                ) =>
                    onQtyChange(
                        e
                            .target
                            .value,
                        index
                    )
                }
            />
              </span><h6 className="d-block ml-5 font-weight-bold">${new Intl.NumberFormat().format(product.price)}</h6>
              <i
              style={{cursor: "pointer"}}
              onClick={() => {
                dispatch(
                    {
                        type: REMOVE_PRODUCT,
                        payload:
                            {
                                ...product,
                            },
                    }
                );

                setProducts(
                    products.filter(
                        (
                            d
                        ) =>
                            d.id !=
                            product.id
                    )
                );
            }}
            
            className="fa fa-trash-o ml-3 text-danger" /></div>
        </div>
            ))}
        </>
        )}
        </>
            )}

      </div>
    </div>
    <div className="col-md-4">
    <article className="border border-gray-200 shadow-sm rounded mb-1 p-3 lg:p-5">
  <ul className="mb-3">
    <li className="text-lg font-bold flex justify-between mt-1 pt-1"> 
      <span>Total price:</span> 
      <span>${new Intl.NumberFormat().format(state.total)}</span>
    </li>
  </ul>
  <a  onClick={() => { if(!window.isLoggedIn){
   window.location.href = "/login?ref=/mall/checkout/cart"
  }else {
    sessionStorage.setItem(
        "cartReact",
        JSON.stringify(state)
    );
    nextStep();
    }
                                                }} style={{color: "#fff"}} className="px-4 py-3 mb-2 inline-block text-lg w-full text-center font-medium text-light bg-green-600 border border-transparent rounded-md hover:bg-green-700" href="#"> Checkout </a>
  <a className="px-4 py-3 inline-block text-lg w-full text-center font-medium text-green-600 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100" href="/products"> Back to shop </a>
</article>

    </div>
  </div>
</div>

                        <section className="d-none pt-5 pb-5">
                            <div className="container">
                                <div className="row w-100">
                                    <div className="col-lg-12 col-md-12 col-12">
                                        <h3 className="display-5 mb-2 text-center">
                                            Shopping Cart
                                        </h3>
                                        {state.count == 0 && (
                                            <p className="mb-5 text-center">
                                                Your cart is currently Empty
                                            </p>
                                        )}

                                        {state.count > 0 && (
                                            <p className="mb-5 text-center">
                                                <i className="text-info font-weight-bold">
                                                    {state.count}
                                                </i>{" "}
                                                items in your cart
                                            </p>
                                        )}

                                        {state.count > 0 && (
                                            <>
                                                <table
                                                    id="shoppingCart"
                                                    className="table table-condensed table-responsive"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                style={{
                                                                    width: "60%",
                                                                }}
                                                            >
                                                                Product
                                                            </th>
                                                            <th
                                                                style={{
                                                                    width: "12%",
                                                                }}
                                                            >
                                                                Price
                                                            </th>
                                                            <th
                                                                style={{
                                                                    width: "10%",
                                                                }}
                                                            >
                                                                Quantity
                                                            </th>
                                                            <th
                                                                style={{
                                                                    width: "16%",
                                                                }}
                                                            ></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {products.length >
                                                            0 && (
                                                            <>
                                                                {products.map(
                                                                    (
                                                                        product,
                                                                        index
                                                                    ) => (
                                                                        <tr
                                                                            key={
                                                                                index
                                                                            }
                                                                        >
                                                                            <td data-th="Product">
                                                                                <div className="row">
                                                                                    <div className="col-md-3 text-left">
                                                                                        <img
                                                                                            src={
                                                                                                product.image
                                                                                            }
                                                                                            alt=""
                                                                                            className="img-fluid d-none d-md-block rounded mb-2 shadow "
                                                                                        />
                                                                                    </div>
                                                                                    <div className="col-md-9 text-left mt-sm-2">
                                                                                        <h4>
                                                                                            {
                                                                                                product.name
                                                                                            }
                                                                                        </h4>
                                                                                        <p className="font-weight-light">
                                                                                            {
                                                                                                product.vendor
                                                                                            }
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td data-th="Price">
                                                                                {
                                                                                    product.price
                                                                                }
                                                                            </td>
                                                                            <td data-th="Quantity">
                                                                                <input
                                                                                    id={
                                                                                        index
                                                                                    }
                                                                                    key={
                                                                                        index
                                                                                    }
                                                                                    type="number"
                                                                                    min="1"
                                                                                    className="form-control form-control-lg text-center"
                                                                                    defaultValue="1"
                                                                                    onChange={(
                                                                                        e
                                                                                    ) =>
                                                                                        onQtyChange(
                                                                                            e
                                                                                                .target
                                                                                                .value,
                                                                                            index
                                                                                        )
                                                                                    }
                                                                                />
                                                                            </td>
                                                                            <td
                                                                                className="actions"
                                                                                data-th=""
                                                                            >
                                                                                <div className="text-right">
                                                                                    <button className="btn btn-white border-secondary bg-white btn-md mb-2">
                                                                                        <i className="fas fa-sync"></i>
                                                                                    </button>
                                                                                    <button
                                                                                        className="btn btn-white border-secondary bg-white btn-md mb-2"
                                                                                        onClick={() => {
                                                                                            dispatch(
                                                                                                {
                                                                                                    type: REMOVE_PRODUCT,
                                                                                                    payload:
                                                                                                        {
                                                                                                            ...product,
                                                                                                        },
                                                                                                }
                                                                                            );

                                                                                            setProducts(
                                                                                                products.filter(
                                                                                                    (
                                                                                                        d
                                                                                                    ) =>
                                                                                                        d.id !=
                                                                                                        product.id
                                                                                                )
                                                                                            );
                                                                                        }}
                                                                                    >
                                                                                        <i className="fas fa-trash"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    )
                                                                )}
                                                            </>
                                                        )}
                                                    </tbody>
                                                </table>
                                                <div className="float-right text-right">
                                                    <h4>Subtotal:</h4>
                                                    <h1>${state.total}</h1>
                                                </div>
                                            </>
                                        )}
                                    </div>
                                </div>

                                {state.total > 0 && (
                                    <div className="row mt-4 d-flex align-items-center">
                                        <div className="col-sm-6 order-md-2 text-right">
                                            {state.total < 1? "" : <a
                                                className="btn btn-primary mb-4 btn-lg pl-5 pr-5"
                                                onClick={() => {
                                                    sessionStorage.setItem(
                                                        "cartReact",
                                                        JSON.stringify(state)
                                                    );
                                                    nextStep();
                                                }}
                                            >
                                                Checkout
                                            </a>}
                                        </div>
                                        <div className="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                                            <a href="javascript:location.assign('/mall')">
                                                <i className="fas fa-arrow-left mr-2"></i>{" "}
                                                Continue Shopping
                                            </a>
                                        </div>
                                    </div>
                                )}
                            </div>
                        </section>
                    </div>
                );
            }}
        </CartContext.Consumer>
    );
};

export default Cart;
