import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface Customer {
    id: number;
    name: string;
    lastname: string;
    email: string;
    phone: string;
}

export interface CartProduct {
    id: number;
    name: string;
    tax: number;
    price: number;
    quantity: number;
}

export interface OrderProduct {
    id: number;
    product: CartProduct;
    tax: number;
    price: number;
    quantity: number;
}

export interface Order {
    id: number;
    folio: string;
    order_date: string;
    customer: Customer;
    status: string;
    order_products: OrderProduct[];
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
