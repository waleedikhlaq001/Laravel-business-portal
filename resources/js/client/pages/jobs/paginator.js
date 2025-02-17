import React, { useState } from "react";
import { Pagination } from "@mantine/core";
export default function Paginator() {
    const [activePage, setPage] = useState(1);
    return (
        <Pagination
            size="xs"
            color="violet"
            page={activePage}
            position="right"
            onChange={setPage}
        />
    );
}
