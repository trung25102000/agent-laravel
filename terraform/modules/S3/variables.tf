variable "bucket_name" {
  description = "Name of the S3 bucket to create."
  type        = string
}

variable "tags" {
  description = "Optional tags applied to the bucket."
  type        = map(string)
  default     = {}
}
