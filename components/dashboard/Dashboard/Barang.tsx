"use client";

import React from "react";
import TableDataPelatihan from "../Pelatihan/TableDataPelatihan";
import { TbSchool, TbShoppingCart } from "react-icons/tb";
import { FaBoxOpen } from "react-icons/fa6";
import TableDataBarang from "../Pelatihan/TableDataBaranng";

const Barang: React.FC = () => {
  return (
    <>
      <div className="flex flex-col">
        <div className="flex flex-row gap-2 items-center">
          <FaBoxOpen className="text-4xl" />
          <div className="flex flex-col">
            <h1 className="text-3xl font-medium leading-[100%] font-calsans">
              Data Barang
            </h1>
            <p className="font-medium text-gray-400 text-base">
              Tambahkan data barang yang kamu jual pada CV Fajar Teknika!
            </p>
          </div>
        </div>
      </div>

      <div className="mt-4 md:mt-6 2xl:mt-7.5">
        <TableDataBarang />
      </div>
    </>
  );
};

export default Barang;
