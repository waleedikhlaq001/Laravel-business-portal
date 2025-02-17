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

const removeProductCartSession = async (productId) => {
    let result = await fetch(`${window.location.origin}/cartsession/delete`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            productId,
        }),
    });

    let res = result.json();

    console.log("removed product from cartsession >", res);
};

const reducer = (state, action) => {
    const { type, payload } = action;
    // console.log(state);

    switch (type) {
        case ADD_PRODUCT:
            const newCart = [...state.cart, payload];
            return {
                ...state,
                cart: newCart,
                count: state.count + 1,
            };
            //add a product to the cart
            break;
        case REMOVE_PRODUCT:
            // console.log(payload);
            removeProductCartSession(payload.id); //remove prodcut from cartsession.
            const originalCart = state.cart.filter((d) => d.id != payload.id);
            const localStorageCart = JSON.parse(sessionStorage.getItem("cart"));
            const localStorageCartId = JSON.parse(
                sessionStorage.getItem("cartIdStore")
            );
            const localStorageNewCart = localStorageCart.filter(
                (d) => d.id != payload.id
            );
            const localStorageNewCartId = localStorageCartId.filter(
                (d) => d != payload.id
            );
            // console.log(localStorageNewCartId);
            sessionStorage.setItem("cart", JSON.stringify(localStorageNewCart));
            sessionStorage.setItem(
                "cartIdStore",
                JSON.stringify(localStorageNewCartId)
            );
            return {
                ...state,
                cart: originalCart,
                count: state.count <= 0 ? 0 : state.count - 1,
                qty: state.qty.filter((d, index) => index != payload.id - 1),
            };
            //add a product to the cart
            break;
        case EMPTY_CART:
            return {
                ...state,
                cart: [],
                count: 0,
                qty: [],
            };
            //add a product to the cart
            break;
        case UPDATE_CART:
            console.log(payload);
            return {
                ...state,
                cart: [0],
                count: 0,
                qty: [],
            };
            //add a product to the cart
            break;
        case UPDATE_PRODUCT_PROPERTY:
            // console.log(payload);
            //add a product to the cart
            break;
        case UPDATE_QTY:
            // console.log(payload);
            const { value, index } = payload;
            let qtyArray = [...state.qty];

            qtyArray[index] = value;
            return {
                ...state,
                qty: qtyArray,
            };
            //add a product to the cart
            break;
        case REFRESH_CART:
            //refresh a product to the cart
            break;
        case UPDATE_CART_SUBTOTAL:
            //update a product to the cart
            //paylaod should be the qty

            let priceArray = [];
            let qtyArr = state.qty;
            state.cart.map((item, index) => {
                priceArray.push(parseInt(item.price) * parseInt(qtyArr[index]));
            });

            const total = priceArray.reduce(
                (accumulator, currentValue) => accumulator + currentValue,
                0
            );

            return {
                ...state,
                total,
            };
            break;

        default:
            break;
    }
};

export default reducer;
