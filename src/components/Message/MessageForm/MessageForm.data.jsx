import * as Yup from "yup";
import { generarId } from "../../../helpers";

export function initialValues() {
  return {
    messages: [
      { id: generarId(), text: "Hi! Nice to meet you" },
      { id: generarId(), text: "What would you like to know?" },
    ],
  };
}

export function validationSchema() {
  return Yup.object({
    messages: Yup.string().required(true),
  });
}
