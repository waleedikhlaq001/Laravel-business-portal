/**
 * External Dependencies
 */
import React, { useRef } from "react";
import { Input } from "@mantine/core";
import { MagnifyingGlassIcon } from "@radix-ui/react-icons";
import Chip from "@mui/material/Chip";
import Stack from "@mui/material/Stack";
/**
 * Internal Dependencies
 */
import JobContext from "./context";
export default function SearchBar({}) {
    const ref = useRef(null);
    const handleDelete = () => {
        console.info("You clicked the delete icon.");
    };
    const handleInputChange = async () => {
        console.log("ref value: ", ref.current.value);
        //handleSearchQuery(ref.current.value);
    };
    return (
        <JobContext.Consumer>
            {(context) => (
                <div>
                    <Input
                        ref={ref}
                        icon={<MagnifyingGlassIcon />}
                        placeholder="Search for projects"
                        radius="xl"
                        color="violet"
                        size="md"
                        onChange={(v) => {
                            console.log(ref.current.value);
                            // handleInputChange();
                            context.setSearchQuery(ref.current.value);
                        }}
                    />

                    <Stack direction="row" spacing={1} className="mt-2">
                        <Chip
                            label="Fashion"
                            color="primary"
                            onDelete={handleDelete}
                            size="small"
                        />
                        <Chip
                            label="Clothes"
                            color="primary"
                            size="small"
                            onDelete={handleDelete}
                        />
                    </Stack>
                </div>
            )}
        </JobContext.Consumer>
    );
}
